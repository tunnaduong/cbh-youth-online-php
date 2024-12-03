@extends('layouts.error')

@section('content')
    <div class="p-6">
        <div class="bg-white p-6 rounded-2xl border shadow-md">
            <div class="space-y-0.5">
                <h2 class="text-2xl font-bold tracking-tight">Settings</h2>
                <p class="text-muted-foreground"> Manage your account settings and set e-mail preferences. </p>
            </div>
            <div class="my-6 border-top"></div>
            <div class="flex gap-x-12">
                <aside class="w-1/5">
                    <ul class="uk-nav uk-nav-primary" uk-switcher="connect: #component-nav; animation: uk-animation-fade"
                        uk-nav>
                        <li class="uk-active">
                            <a href="#">Profile</a>
                        </li>
                        <li>
                            <a href="#">Account</a>
                        </li>
                        <li>
                            <a href="#">Appearance</a>
                        </li>
                        <li>
                            <a href="#">Notifications</a>
                        </li>
                        <li>
                            <a href="#">Display</a>
                        </li>
                    </ul>
                </aside>
                <div class="flex-1">
                    <ul id="component-nav" class="uk-switcher max-w-2xl">
                        <li class="uk-active space-y-6">
                            <div>
                                <h3 class="text-lg font-medium">Profile</h3>
                                <p class="text-sm text-muted-foreground"> This is how others will see you on the site. </p>
                            </div>
                            <div class="border-t border-border"></div>
                            <div class="space-y-2">
                                <label class="uk-form-label" for="username">Username</label>
                                <input class="uk-input" id="username" type="text" placeholder="sveltecult">
                                <div class="uk-form-help text-muted-foreground"> This is your public display name. It can be
                                    your
                                    real name or a pseudonym. You can only change this once every 30 days. </div>
                            </div>
                            <div class="space-y-2">
                                <label class="uk-form-label" for="email">Email</label>
                                <div class="h-9">
                                    <uk-select name="email" id="email" uk-cloak="true">
                                        <option value="" selected disabled> Select a verified email to display
                                        </option>
                                        <option>
                                            <template class="__cf_email__"
                                                data-cfemail="dbb69bbea3bab6abb7bef5b8b4b6">[email&#160;protected]</template>
                                        </option>
                                        <option>
                                            <template class="__cf_email__"
                                                data-cfemail="107d506971787f7f3e737f7d">[email&#160;protected]</template>
                                        </option>
                                        <option>
                                            <template class="__cf_email__"
                                                data-cfemail="0a674a6966657f6e24696567">[email&#160;protected]</template>
                                        </option>
                                    </uk-select>
                                </div>
                                <div class="uk-form-help text-muted-foreground"> You can manage verified email addresses in
                                    your
                                    email settings. </div>
                            </div>
                            <div class="space-y-2">
                                <label class="uk-form-label text-destructive" for="bio">Bio</label>
                                <textarea class="uk-textarea uk-form-danger" id="bio" placeholder="Tell us a little bit about yourself"></textarea>
                                <div class="uk-form-help text-muted-foreground"> You can @mention other users and
                                    organizations
                                    to
                                    link to them. </div>
                                <div class="uk-form-help text-destructive"> String must contain at least 4 character(s)
                                </div>
                            </div>
                            <div class="space-y-2">
                                <span class="uk-form-label">URLs</span>
                                <div class="uk-form-help text-muted-foreground"> Add links to your website, blog, or social
                                    media
                                    profiles. </div>
                                <input class="uk-input" readonly type="text" value="https://www.franken-ui.dev">
                                <input class="uk-input" readonly type="text"
                                    value="https://github.com/sveltecult/franken-ui">
                                <button class="uk-button uk-button-default" uk-toggle="#demo"> Add URL </button>
                            </div>
                            <div class="">
                                <button class="uk-button uk-button-primary" uk-toggle="#demo"> Update profile </button>
                            </div>
                        </li>
                        <li class="space-y-6">
                            <div>
                                <h3 class="text-lg font-medium">Account</h3>
                                <p class="text-sm text-muted-foreground"> Update your account settings. Set your preferred
                                    language
                                    and timezone. </p>
                            </div>
                            <div class="border-t border-border"></div>
                            <div class="space-y-2">
                                <label class="uk-form-label" for="name">Name</label>
                                <input class="uk-input" id="name" type="text" placeholder="Your name">
                                <div class="uk-form-help text-muted-foreground"> This is the name that will be displayed on
                                    your
                                    profile and in emails. </div>
                            </div>
                            <div class="space-y-2">
                                <label class="uk-form-label block" for="date_of_birth">Date of Birth</label>
                                <input class="uk-input w-[240px]" id="date_of_birth" type="date"
                                    placeholder="Pick a date">
                                <div class="uk-form-help text-muted-foreground"> Your date of birth is used to calculate
                                    your
                                    age.
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="uk-form-label block" for="language">Language</label>
                                <div class="h-9">
                                    <uk-select name="language" uk-cloak="true">
                                        <option value="" disabled> Select a language </option>
                                        <option selected>English</option>
                                        <option>French</option>
                                        <option>German</option>
                                        <option>Spanish</option>
                                        <option>Portuguese</option>
                                    </uk-select>
                                </div>
                                <div class="uk-form-help text-muted-foreground"> This is the language that will be used in
                                    the
                                    dashboard. </div>
                            </div>
                            <div class="">
                                <button class="uk-button uk-button-primary" uk-toggle="#demo"> Update profile </button>
                            </div>
                        </li>
                        <li class="space-y-6">
                            <div>
                                <h3 class="text-lg font-medium">Appearance</h3>
                                <p class="text-sm text-muted-foreground"> Customize the appearance of the app.
                                    Automatically
                                    switch
                                    between day and night themes. </p>
                            </div>
                            <div class="border-t border-border"></div>
                            <div class="space-y-2">
                                <label class="uk-form-label block" for="email">Font Family</label>
                                <div class="h-9">
                                    <uk-select name="email" id="email" uk-cloak="true">
                                        <option value="" disabled> Select a font family </option>
                                        <option>Inter</option>
                                        <option selected>Geist</option>
                                        <option>Open Sans</option>
                                    </uk-select>
                                </div>
                                <div class="uk-form-help text-muted-foreground"> Set the font you want to use in the
                                    dashboard.
                                </div>
                            </div>
                            <div class="space-y-2">
                                <span class="uk-form-label">Theme</span>
                                <div class="uk-form-help text-muted-foreground"> Select the theme for the dashboard. </div>
                                <div class="grid max-w-md grid-cols-2 gap-8">
                                    <a class="block cursor-pointer items-center rounded-md border-2 border-muted p-1 ring-ring"
                                        id="theme-toggle-light">
                                        <div class="space-y-2 rounded-sm bg-[#ecedef] p-2">
                                            <div class="space-y-2 rounded-md bg-white p-2 shadow-sm">
                                                <div class="h-2 w-[80px] rounded-lg bg-[#ecedef]"></div>
                                                <div class="h-2 w-[100px] rounded-lg bg-[#ecedef]"></div>
                                            </div>
                                            <div class="flex items-center space-x-2 rounded-md bg-white p-2 shadow-sm">
                                                <div class="h-4 w-4 rounded-full bg-[#ecedef]"></div>
                                                <div class="h-2 w-[100px] rounded-lg bg-[#ecedef]"></div>
                                            </div>
                                            <div class="flex items-center space-x-2 rounded-md bg-white p-2 shadow-sm">
                                                <div class="h-4 w-4 rounded-full bg-[#ecedef]"></div>
                                                <div class="h-2 w-[100px] rounded-lg bg-[#ecedef]"></div>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="block cursor-pointer items-center rounded-md border-2 border-muted bg-popover p-1 ring-ring"
                                        id="theme-toggle-dark">
                                        <div class="space-y-2 rounded-sm bg-slate-950 p-2">
                                            <div class="space-y-2 rounded-md bg-slate-800 p-2 shadow-sm">
                                                <div class="h-2 w-[80px] rounded-lg bg-slate-400"></div>
                                                <div class="h-2 w-[100px] rounded-lg bg-slate-400"></div>
                                            </div>
                                            <div class="flex items-center space-x-2 rounded-md bg-slate-800 p-2 shadow-sm">
                                                <div class="h-4 w-4 rounded-full bg-slate-400"></div>
                                                <div class="h-2 w-[100px] rounded-lg bg-slate-400"></div>
                                            </div>
                                            <div class="flex items-center space-x-2 rounded-md bg-slate-800 p-2 shadow-sm">
                                                <div class="h-4 w-4 rounded-full bg-slate-400"></div>
                                                <div class="h-2 w-[100px] rounded-lg bg-slate-400"></div>
                                            </div>
                                        </div>
                                    </a>
                                    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
                                    <script>
                                        const htmlElement = document.documentElement;
                                        const light = document.getElementById("theme-toggle-light");
                                        const dark = document.getElementById("theme-toggle-dark");
                                        if (htmlElement.classList.contains("dark")) {
                                            dark.classList.add("ring-2");
                                        } else {
                                            light.classList.add("ring-2");
                                        }
                                        light.addEventListener("click", () => {
                                            htmlElement.classList.remove("dark");
                                            light.classList.add("ring-2");
                                            dark.classList.remove("ring-2");
                                        });
                                        dark.addEventListener("click", () => {
                                            htmlElement.classList.add("dark");
                                            light.classList.remove("ring-2");
                                            dark.classList.add("ring-2");
                                        });
                                    </script>
                                </div>
                            </div>
                            <div class="">
                                <button class="uk-button uk-button-primary" uk-toggle="#demo"> Update preferences
                                </button>
                            </div>
                        </li>
                        <li class="space-y-6">
                            <div>
                                <h3 class="text-lg font-medium">Notifications</h3>
                                <p class="text-sm text-muted-foreground"> Configure how you receive notifications. </p>
                            </div>
                            <div class="border-t border-border"></div>
                            <div class="space-y-2">
                                <span class="uk-form-label"> Notify me about </span>
                                <label class="block text-sm" for="notification_0">
                                    <input id="notification_0" class="uk-radio mr-2" name="notification" type="radio">
                                    All
                                    new
                                    messages </label>
                                <label class="block text-sm" for="notification_1">
                                    <input id="notification_1" class="uk-radio mr-2" name="notification" type="radio">
                                    Direct
                                    messages and mentions </label>
                                <label class="block text-sm" for="notification_2">
                                    <input id="notification_2" class="uk-radio mr-2" name="notification" type="radio"
                                        checked="true"> Nothing </label>
                            </div>
                            <div>
                                <h3 class="mb-4 text-lg font-medium">Email Notifications</h3>
                                <div class="space-y-4">
                                    <div class="flex items-center justify-between rounded-lg border border-border p-4">
                                        <div class="space-y-0.5">
                                            <label class="text-base font-medium" for="email_notification_0"> Communication
                                                emails
                                            </label>
                                            <div class="uk-form-help text-muted-foreground"> Receive emails about your
                                                account
                                                activity. </div>
                                        </div>
                                        <input class="uk-toggle-switch uk-toggle-switch-primary" id="email_notification_0"
                                            type="checkbox">
                                    </div>
                                    <div class="flex items-center justify-between rounded-lg border border-border p-4">
                                        <div class="space-y-0.5">
                                            <label class="text-base font-medium" for="email_notification_1"> Marketing
                                                emails
                                            </label>
                                            <div class="uk-form-help text-muted-foreground"> Receive emails about new
                                                products,
                                                features, and more. </div>
                                        </div>
                                        <input class="uk-toggle-switch uk-toggle-switch-primary" id="email_notification_1"
                                            type="checkbox">
                                    </div>
                                    <div class="flex items-center justify-between rounded-lg border border-border p-4">
                                        <div class="space-y-0.5">
                                            <label class="text-base font-medium" for="email_notification_2"> Social emails
                                            </label>
                                            <div class="uk-form-help text-muted-foreground"> Receive emails for friend
                                                requests,
                                                follows, and more. </div>
                                        </div>
                                        <input class="uk-toggle-switch uk-toggle-switch-primary" id="email_notification_2"
                                            type="checkbox" checked="true">
                                    </div>
                                    <div class="flex items-center justify-between rounded-lg border border-border p-4">
                                        <div class="space-y-0.5">
                                            <label class="text-base font-medium" for="email_notification_3"> Security
                                                emails
                                            </label>
                                            <div class="uk-form-help text-muted-foreground"> Receive emails about your
                                                account
                                                activity and security. </div>
                                        </div>
                                        <input class="uk-toggle-switch uk-toggle-switch-primary" id="email_notification_3"
                                            type="checkbox" checked="true" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="flex gap-x-3">
                                <input class="uk-checkbox mt-1" id="notification_mobile" type="checkbox" checked>
                                <div class="space-y-1">
                                    <label class="uk-form-label" for="notification_mobile"> Use different settings for my
                                        mobile
                                        devices </label>
                                    <div class="uk-form-help text-muted-foreground"> You can manage your mobile
                                        notifications
                                        in
                                        the mobile settings page. </div>
                                </div>
                            </div>
                            <div class="">
                                <button class="uk-button uk-button-primary" uk-toggle="#demo"> Update notifications
                                </button>
                            </div>
                        </li>
                        <li class="space-y-6">
                            <div>
                                <h3 class="text-lg font-medium">Display</h3>
                                <p class="text-sm text-muted-foreground"> Turn items on or off to control what's displayed
                                    in
                                    the
                                    app. </p>
                            </div>
                            <div class="border-t border-border"></div>
                            <div class="space-y-2">
                                <div class="mb-4">
                                    <span class="text-base font-medium"> Sidebar </span>
                                    <div class="uk-form-help text-muted-foreground"> Select the items you want to display
                                        in
                                        the
                                        sidebar. </div>
                                </div>
                                <label class="block text-sm" for="display_0">
                                    <input class="uk-checkbox mr-2" type="checkbox" checked="true"> Recents </label>
                                <label class="block text-sm" for="display_1">
                                    <input class="uk-checkbox mr-2" type="checkbox" checked="true"> Home </label>
                                <label class="block text-sm" for="display_2">
                                    <input class="uk-checkbox mr-2" type="checkbox" checked="true"> Applications </label>
                                <label class="block text-sm" for="display_3">
                                    <input class="uk-checkbox mr-2" type="checkbox"> Desktop </label>
                                <label class="block text-sm" for="display_4">
                                    <input class="uk-checkbox mr-2" type="checkbox"> Downloads </label>
                                <label class="block text-sm" for="display_5">
                                    <input class="uk-checkbox mr-2" type="checkbox"> Documents </label>
                            </div>
                            <div class="">
                                <button class="uk-button uk-button-primary" uk-toggle="#demo"> Update display </button>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
