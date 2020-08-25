<div id="widget_meedget" class="meedgetwhite roundcorner">
    <ul style="display: block;">
        <li><a class="meedget_calc" href="javascript:void(0);"><span>Калькулятор</span></a></li>
    </ul>
</div>

<div class="meedget_popup">
    <div class="meedget__block container" class="roundcorner"><a class="meedget_close_link" onclick="closeAll()"></a>
        <?php if ($_GET['calc'] === 'success'): ?>
            <div class="stepFinish" style="display: block;"><div><h3>Спасибо, мы скоро с вами свяжемся!</h3></div></div>
        <?php endif; ?>
        <div class="meedget_popup_content" style="display: none;"><h2 class="calc_title">Калькулятор</h2>
            <div id="meedget_calc_inner">
                <div class="step1" style="display: block;">
                    <div class="meedget_inner"><h3 class="meedget_question">Услуга, которая вас интересует</h3>
                        <div class="meedget_center meedget_label_radio">
                            <div>
                                <p><input class="radio1" name="choice" type="radio" value="alertb"> Тревожная кнопка</p>
                                <p><input class="radio1" name="choice" type="radio" value="signal"> Сигнализация</p>
                                <p><input class="radio1" name="choice" type="radio" value="fizsec"> Физическая охрана</p>
                                <p><input class="radio1" name="choice" type="radio" value="incas"> Инкасация</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="step2" style="display: none;">
                    <div class="meedget_inner"><h3 class="meedget_question">Тип сигнализации</h3>
                        <div class="meedget_center meedget_label_radio">
                            <div>
                                <p><input class="radio2" name="choice" type="radio" value="flat"> Квартира</p>
                                <p><input class="radio2" name="choice" type="radio" value="house"> Дом</p>
                                <p><input class="radio2" name="choice" type="radio" value="maf"> Маф</p>
                                <p><input class="radio2" name="choice" type="radio" value="business"> Бизнес</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="step3" style="display: none;">
                    <div class="meedget_inner"><h3 class="meedget_question">Тип подключения</h3>
                        <div class="meedget_center meedget_label_radio">
                            <div>
                                <p><input class="radio3" name="choice" type="radio" value="wired"> Проводная</p>
                                <p><input class="radio3" name="choice" type="radio" value="non-wired"> Беспроводная</p>
                            </div>
                        </div>
                    </div>
                </div>
                <p><input class="radio1answer modal_form_btn" type="submit" value="Следующий шаг"></p>
                <form method="post" class="contact" action="<?php echo admin_url('admin-post.php'); ?>" style="display: none">
                    <p><b>Заполните форму для связи со специалистом + (телефон, имя)</b></p>
                    <p>Имя
                        <input type="text" name="name" maxlength="30" required>
                    </p>
                    <p>Телефон
                        <input type="text" name="phone"  pattern="\+7\s?[\(]{0,1}9[0-9]{2}[\)]{0,1}\s?\d{3}[-]{0,1}\d{2}[-]{0,1}\d{2}" required>
                    </p>
                    <input type="hidden" name="action" value="modal-form">
                    <p><input class="modal_form_btn" type="submit" value="Отправить"></p>
<!--                    <button class="send" data-href="--><?php //echo esc_url(admin_url('admin-ajax.php')); ?><!--">Отправить</button>-->
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    let meedget_calc = document.querySelector('.meedget_calc');
    let meedget_popup = document.querySelector('.meedget_popup');
    let meedget_popup_content = document.querySelector('.meedget_popup_content');
    let radio1answer = document.querySelector('.radio1answer');
    let meedget__block_fixed = document.querySelector('.meedget__block.fixed')
    let send = document.querySelector('.send');
    let stepFinish = document.querySelector('.stepFinish');

    let step1 = document.querySelector('.step1');
    let step2 = document.querySelector('.step2');
    let step3 = document.querySelector('.step3');

    let service = null;
    let signal = null;
    let wire = null;

    let serviceType = null;
    let signalType = null;
    let wireType = null;

    let contactForm = document.querySelector('.contact');

    let radio1 = document.querySelectorAll('.radio1');
    let radio2 = document.querySelectorAll('.radio2');
    let radio3 = document.querySelectorAll('.radio3');

    meedget_calc.onclick = function () {
        meedget_popup_content.style.display = 'block';
        meedget_popup.style.display = 'block';
        stepFinish.style.display = 'none';
        meedget__block_fixed.classList.toggle('hiddenBlock');
    }

    for (let i = 0; i < radio1.length; i++) {
        radio1[i].onchange = function() {
            service = radio1[i].value;
            serviceType = document.createElement('input');
            serviceType.type = 'hidden';
            serviceType.value = service;
            serviceType.name = 'service';
        }
    }
    for (let i = 0; i < radio2.length; i++) {
        radio2[i].onchange = function() {
            signal = radio2[i].value;
            signalType = document.createElement('input');
            signalType.type = 'hidden';
            signalType.value = signal;
            signalType.name = 'signal';
        }
    }
    for (let i = 0; i < radio3.length; i++) {
        radio3[i].onchange = function() {
            wire = radio3[i].value;
            wireType = document.createElement('input');
            wireType.type = 'hidden';
            wireType.value = wire;
            wireType.name = 'wire';
        }
    }

    radio1answer.onclick = function () {
        if (service === 'alertb' || service === 'fizsec' || service === 'incas' || wire) {
            displayContactForm();
        }
        if (service === 'signal') {
            displaySecondStep();
        }
        if (signal) {
            displayThirdStep();
        }
    }

    function displayContactForm() {
        step1.style.display = 'none';
        step3.classList.toggle('hiddenBlock');
        radio1answer.style.display = 'none';
        contactForm.append(serviceType);
        contactForm.style.display = 'block';
        if (wireType) {
            contactForm.append(wireType);
        }
    }

    function displaySecondStep(){
        step1.style.display = 'none';
        step2.style.display =  'block';
    }

    function displayThirdStep(){
        step2.style.display =  'none';
        step3.style.display =  'block';
        contactForm.append(signalType);
    }

    function closeAll(){
        meedget_popup_content.style.display = 'none';
        meedget_popup.style.display = 'none';
    }

    /*send.onclick = function (e) {
        e.preventDefault();
        const xhr = new XMLHttpRequest();
        xhr.open('POST', send.getAttribute('data-href'));
    }*/
</script>
<style>
    a.meedget_close_link {
        position: absolute !important;
        right: 0 !important;
        background: url(https://meedget.ru/images/close_icon.png) no-repeat !important; /*обязательно поменять путь*/
        padding: 25px 25px 0 0 !important;
        margin: 0 29px 0 0 !important;
        cursor: pointer;
    }

    .calc_title {
        color: #444 !important;
        font-size: 32px !important;
        font-family: 'Open Sans Light','Open Sans',Arial !important;
        font-weight: 100 !important;
        line-height: normal !important;
        margin: 33px 0 0 !important;
        padding: 0 !important;
    }

    .meedget_question {
        color: #666 !important;
        line-height: 22px !important;
        font-size: 18px !important;
        font-family: 'Open Sans Semibold','Open Sans' !important;
        font-weight: 600 !important;
        margin: 19px 0 9px !important;
    }

    .modal_form_btn {
        height: 44px;
        position: inherit !important;
        background-position: left !important;
        background-repeat: no-repeat !important;
        background-color: rgb(173,35,35) !important;
        color: #fff !important;
        font-size: 18px !important;
        border: none !important;
        cursor: pointer !important;
        padding: 0 17px 0 46px !important;
        margin: 25px 0 0 !important;
    }

    #widget_meedget {
        width: 196px;
    }

    #widget_meedget ul > li {
        margin: 0 !important;
        width: 100% !important;
        background: rgb(173, 35, 35) !important;
        color: #444 !important;
        font-weight: 700 !important;
        list-style: none !important;
        text-decoration: none !important;
        border-top: 1px solid rgb(193, 55, 55) !important;
        border-left: 1px solid rgb(193, 55, 55) !important;
        padding: 17px !important;
        box-sizing: border-box !important;
        border-top-left-radius: 13px;
        border-bottom-left-radius: 13px;
    }

    #widget_meedget.meedgetwhite ul > li > a {
        background-repeat: no-repeat;
        color: #FFF !important;
        /*padding: 17px 0 17px 17px;*/
        text-transform: uppercase;
        text-decoration: none;
    }

    #meedget_popup {
        position: absolute !important;
        width: 100% !important;
        min-height: 100% !important;
        z-index: 9998 !important;
    }

    .meedget__block {
        position: relative !important;
        width: 472px !important;
        background: #fff !important;
        border: 3px solid rgb(173,35,35) !important;
        padding: 23px 85px 0 !important;
        margin: 3% auto !important;
        border-radius: 13px;
    }

    .meedget__block.fixed {
        position: fixed !important;
        left: 25%;
    }

    #meedget_block.roundcorner {
        border-radius: 13px;
    }

    #meedget_block div {
        float: left;
        width: 100%;
    }

    .hiddenBlock {
        display: none!important;
    }
</style>
