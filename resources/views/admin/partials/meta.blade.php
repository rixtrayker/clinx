<base href="{{App::make("url")->to('/')}}/" />
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Mouldifi - A fully responsive, HTML5 based admin theme">
<meta name="keywords" content="Responsive, HTML5, admin theme, business, professional, Mouldifi, web design, CSS3">
<title>{{Session::get('configs')['site_title']}} - لوحة التحكم</title>
<!-- Site favicon -->
<link rel='shortcut icon' type='image/x-icon' href="{{url('/')}}/uploads/logos/{{Session::get('configs')['favicon']}}" />
<!-- /site favicon -->
