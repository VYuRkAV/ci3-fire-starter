<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Users Language File
 */

// Titles
$lang['users title forgot']                   = "Забутий пароль";
$lang['users title login']                    = "Авторизація";
$lang['users title profile']                  = "Профіль";
$lang['users title register']                 = "Реєстрація";
$lang['users title user_add']                 = "Додавання користувача";
$lang['users title user_delete']              = "Підтвердження видалення користувача";
$lang['users title user_edit']                = "Редагування користувача";
$lang['users title user_list']                = "Список користувачів";

// Buttons
$lang['users button add_new_user']            = "Створити нового користувача";
$lang['users button register']                = "Створити аккаунт";
$lang['users button reset_password']          = "Скинути пароль";
$lang['users button login_try_again']         = "Спробуйте ще раз";

// Tooltips
$lang['users tooltip add_new_user']           = "Створити нового користувача.";

// Links
$lang['users link forgot_password']           = "Забули пароль?";
$lang['users link register_account']          = "Зареєструватися";

// Table Columns
$lang['users col first_name']                 = "Ім'я";
$lang['users col is_admin']                   = "Адміністратор";
$lang['users col last_name']                  = "Призвище";
$lang['users col user_id']                    = "ID";
$lang['users col username']                   = "Користувач";

// Form Inputs
$lang['users input email']                    = "Email";
$lang['users input first_name']               = "Ім'я";
$lang['users input is_admin']                 = "Адміністратор";
$lang['users input language']                 = "Мова";
$lang['users input last_name']                = "Призвище";
$lang['users input password']                 = "Пароль";
$lang['users input password_repeat']          = "Повторіть пароль";
$lang['users input status']                   = "Статус";
$lang['users input username']                 = "Ім'я користувача";
$lang['users input username_email']           = "Ім'я користувача або Email";

// Help
$lang['users help passwords']                 = "* заповнити лише за необхідності змінити пароль";

// Messages
$lang['users msg add_user_success']           = "%s успішно доданий!";
$lang['users msg delete_confirm']             = "Ви впевнені, що бажаєте видалити <strong>%s</strong>? Скасувати дану дію буде неможливо.";
$lang['users msg delete_user']                = "Ви успішно видалили <strong>%s</strong>!";
$lang['users msg edit_profile_success']       = "Ваш профіль оновлено!";
$lang['users msg edit_user_success']          = "Користувача %s змінено!";
$lang['users msg register_success']           = "%s, Дякуємо Вам за реєстрацію! На вказану вами адресу надіслано листа для підтвердження реєстрації.
                                                 Після підтвердження вашого облікового запису , ви зможете авторизуватися з доступними вам повноваженнями.
                                                 ";
$lang['users msg password_reset_success']     = "Ваш пароль було скинуто, %s! На Ваш Email надіслано листа з тимчасовим паролем.";
$lang['users msg validate_success']           = "Ваш обліковий запис підтверджено. Ви можете увійти в свій обліковий запис.";
$lang['users msg email_new_account']          = "<p>Дякуємо Вам за створення облікового запису %s. Натисніть на посилання нижче, щоб підтвердити вашу пошту
                                                 .<br /><br /><a href=\"%s\">%s</a></p>";
$lang['users msg email_new_account_title']    = "Новий обліковий запис для  %s";
$lang['users msg email_password_reset']       = "<p>%s ваш пароль було скинуто. Натисніть посилання нижче для авторизації з новим паролем
                                                 :<br /><br /><strong>%s</strong><br /><br /><a href=\"%s\">%s</a>
                                                 Після авторизування не забудьте змінити пароль на той, який ви зможете запам'ятати.</p>";
$lang['users msg email_password_reset_title'] = "Скинутий пароль для %s";

// Errors
$lang['users error add_user_failed']          = "%s не вдалося додати!";
$lang['users error delete_user']              = "<strong>%s</strong> не вдалося видалити!";
$lang['users error edit_profile_failed']      = "Ваш профіль не може бути змінено!";
$lang['users error edit_user_failed']         = "%s не можна змінити!";
$lang['users error email_exists']             = "<strong>%s</strong> вже використовується!";
$lang['users error email_not_exists']         = "В системі відсутня адреса електронної пошти для відновлення!";
$lang['users error invalid_login']            = "Невірний логін або пароль";
$lang['users error password_reset_failed']    = "Сталася помилка під час скидання пароля, будь ласка, спробуйте ще раз.";
$lang['users error register_failed']          = "Ваш обліковий запис не можна створити в цей час. Спробуй ще раз.";
$lang['users error user_id_required']         = "Необхідний числовий ідентифікатор користувача!";
$lang['users error user_not_exist']           = "Цей користувач не існує!";
$lang['users error username_exists']          = "Ім'я користувача <strong>%s</strong> вже існує!";
$lang['users error validate_failed']          = "Сталася помилка під час перевірці аккаунта. Спробуй ще раз.";
$lang['users error too_many_login_attempts']  = "Ви зробили надто багато спроб входу в систему. Будь ласка, зачекайте %s секунд і повторіть спробу.";
