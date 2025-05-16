@php
$user_level = session('nivel_acesso');
switch ($user_level) {
    case '1':
        $component = 'components.dashboard-vendas';
        break;
    case '2':
        $component = 'components.dashboard-gestao-produto';
        break;
    case '3':
        $component = 'components.dashbord-financeiro';
        break;
    default:
        $component = 'redirect-login';
}
@endphp
@include($component)