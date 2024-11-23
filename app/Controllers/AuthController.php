<?php

namespace App\Controllers;

use App\Models\AuthAccount;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use App\Controllers\BaseController;

class AuthController extends BaseController
{
    private $authAccount;

    public function __construct()
    {
        $this->authAccount = new AuthAccount();
    }

    public function login()
    {
        if (isset($_SESSION['user'])) {
            header("Location: /");
            exit;
        }

        $error = "";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = $this->authAccount->checkLogin($username, $password);

            if ($user) {
                $user->additional_info = $this->authAccount->getByUsername($user->username);
                $_SESSION['user'] = $user;
                header("Location: /");
                exit;
            } else {
                $error = "Tên đăng nhập hoặc mật khẩu sai!";
            }
        }

        return $this->render('auth.login', compact('error'));
    }

    public function validateUsername($username)
    {
        // Define the regular expression pattern
        $pattern = '/^[a-zA-Z0-9_]{3,20}$/';

        // Check if the username matches the pattern
        return preg_match($pattern, $username);
    }


    public function register()
    {
        $error = "";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // if username or password or email is empty then return error
            if (empty($_POST['username']) || empty($_POST['name']) || empty($_POST['password']) || empty($_POST['email'])) {
                $error = "Tên đăng nhập, họ và tên, mật khẩu và email không được để trống";
                return $this->render('auth.register', compact('error'));
            } else {
                // if password and confirm password is not match then return error
                if ($_POST['password'] != $_POST['confirm_password']) {
                    $error = "Mật khẩu và xác nhận mật khẩu không khớp";
                    return $this->render('auth.register', compact('error'));
                }
            }
            $name = $_POST['name'];
            $username = $_POST['username'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $email = $_POST['email'];

            if (!$this->validateUsername($username)) {
                $error = "Tên đăng nhập không hợp lệ";
                return $this->render('auth.register', compact('error'));
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = "Email không hợp lệ";
                return $this->render('auth.register', compact('error'));
            }

            $user = $this->authAccount->checkExistUsername($username);

            if ($user) {
                $error = "Tên đăng nhập đã tồn tại";
            } else {
                $user = $this->authAccount->checkExistEmail($email);

                if ($user) {
                    $error = "Email đã tồn tại";
                } else {
                    $this->authAccount->register($username, $password, $email, $name);

                    $user = $this->authAccount->getUserData($username);
                    // Generate a unique verification token
                    $token = bin2hex(random_bytes(32));

                    $this->authAccount->saveVerificationToken($user->id, $token);

                    $this->sendVerificationEmail($user->email, $token);

                    if ($user) {
                        $user->additional_info = $this->authAccount->getByUsername($user->username);
                        $_SESSION['user'] = $user;
                        header("Location: /");
                        exit;
                    } else {
                        $error = "Đã xảy ra lỗi không mong muốn. Vui lòng thử lại sau";
                    }
                }
            }
        }

        return $this->render('auth.register', compact('error'));
    }

    private function sendVerificationEmail($email, $token)
    {
        $verificationLink = BASE_URL . "email/verify/" . $token;

        $mail = new PHPMailer(true);
        try {
            $mail->SMTPOptions = [
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                ]
            ];
            //Server settings
            $mail->isSMTP();
            $mail->Host = MAIL_HOST;
            $mail->SMTPAuth = true;
            $mail->Username = MAIL_USERNAME;
            $mail->Password = MAIL_PASSWORD;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = MAIL_PORT;
            $mail->CharSet = "UTF-8";
            $mail->Encoding = 'base64';

            //Recipients
            $mail->setFrom(MAIL_USERNAME, 'Thanh niên Chuyên Biên Hòa Online');
            $mail->addAddress($email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Xác minh địa chỉ email của bạn';
            $mail->Body    = 'Bấm vào <a href="' . $verificationLink . '">đây</a> để xác minh địa chỉ email của bạn. Đường liên kết này sẽ hết hạn trong 1 tiếng nữa nếu bạn không xác minh.<br /><br />Trân trọng,<br />Đội ngũ CBH Youth Online';

            $mail->send();
        } catch (Exception $e) {
            echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    public function verifyEmail($token)
    {
        // Check if the token exists in the database
        $userId = $this->authAccount->getUserIdByToken($token);

        if ($userId) {
            // Mark the user as verified by setting verified_at timestamp
            $this->authAccount->markAsVerified($userId);

            if ($this->authAccount->checkVerified($userId)) {
                return $this->render('errors.verifyEmailFailed');
            }

            return $this->render('success.verifyEmail');
        } else {
            return $this->render('errors.verifyEmailFailed');
        }
    }

    public function logout()
    {
        unset($_SESSION['user']);
        header("Location: /login");
        exit;
    }
}
