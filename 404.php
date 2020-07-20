<?
include_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/urlrewrite.php');
CHTTP::SetStatus("404 Not Found");
@define("ERROR_404", "Y");

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

$APPLICATION->SetTitle("Страница не найдена");
$APPLICATION->SetPageProperty("keywords", "Страница не найдена");
$APPLICATION->SetPageProperty("description", "Страница не найдена");
?>

<div class="container">
    <section class="http-error">
        <div class="row justify-content-center py-3">
            <div class="col-md-7 text-center">
                <div class="http-error-main">
                    <h2>404!</h2>
                    <p>Страница не найдена</p>
                </div>
            </div>
            <div class="col-md-4 mt-4 mt-md-0">
                <h4 class="text-primary">Полезные ссылки</h4>
                <ul class="nav nav-list flex-column">
                    <li class="nav-item"><a class="nav-link" href="/">Главная</a></li>
                    <li class="nav-item"><a class="nav-link" href="/login/">Войти</a></li>
                    <li class="nav-item"><a class="nav-link" href="/registration/">Регистрация</a></li>
                </ul>
            </div>
        </div>
    </section>

</div>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>

