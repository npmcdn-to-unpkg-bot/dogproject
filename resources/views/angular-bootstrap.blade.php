<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Petagree</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href="/css/bootstrap.min.css" media="all" type="text/css" rel="stylesheet">
    <link href="/css/angular-toastr.css" media="all" type="text/css" rel="stylesheet">
    <link href="/css/nouislider.min.css" media="all" type="text/css" rel="stylesheet">
    <link href="/css/app.css" media="all" type="text/css" rel="stylesheet">


</head>
<body ng-app="petagree">


<div ng-include src="'js/app/modules/core/header/view.html'"></div>
<div ui-view  autoscroll="true"></div>
<div ng-include src="'js/app/modules/core/footer/view.html'"></div>

<script src="https://cdn.jsdelivr.net/lodash/4.5.1/lodash.min.js"></script>
<script src="/js/lib/moment.js"></script>
<script src="/js/angular-dependencies.js"></script>
<script src="/js/app/services/BeyondiFilters.js"></script>
<script src="/js/app/services/BeyondiThorAuth.js"></script>
<script src="/js/app.js"></script>
</body>
</html>