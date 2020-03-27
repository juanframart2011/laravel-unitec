<head>
    <title>{{ env( 'APP_NAME' ) . ' - ' . $meta_title }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset( 'css/main.css' ) }}" />
    <link rel="stylesheet" href="{{ asset( 'font/font-awesome/css/font-awesome.min.css' ) }}">
    <script type="text/javascript">
        var base_url = '<?= env( 'APP_URL' ) ?>';
    </script>
</head>