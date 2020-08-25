<?php
add_action('admin_post_nopriv_modal-form', 'modal_form_handler');
add_action('admin_post_modal-form', 'modal_form_handler');

//add_action('wp_ajax_nopriv_i-modal-form', 'modal_form_handler');
//add_action('admin_post_i-modal-form', 'modal_form_handler');



function modal_form_handler () {
    $values = [
        'alertb' => 'Тревожная кнопка',
        'signal' => 'Сигнализация',
        'fizsec' => 'Физическая охрана',
        'incas'  => 'Инкасация',
        'flat'   => 'Квартира',
        'house'  => 'Дом',
        'maf'    => 'Маф',
        'business' => 'Бизнес',
        'wired' => 'Проводная',
        'non-wired' => 'Беспроводная',
    ];
    $signalType = null;
    $wireType = null;

    $name = 'Имя: ' . wp_strip_all_tags($_POST['name']);
    $phone = 'Телефон: ' . wp_strip_all_tags($_POST['phone']);
    $service = 'Услуга: ' . $values[$_POST['service']];
    if ($_POST['signal']) {
        $signalType = 'Тип сигнализации: ' . $values[$_POST['signal']];
    }
    if ($_POST['wire']) {
        $wireType = 'Тип подключения: ' . $values[$_POST['wire']];
    }
    $message = $service . '<br>' . $phone . '<br>' . $name . '<br>' . $signalType . ' ' . $wireType;

    wp_mail('hugopochta@gmail.com', 'Заявка с калькулятора', $message);

    header('Location: /?calc=success');
}