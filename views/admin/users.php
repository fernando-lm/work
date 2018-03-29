<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?=$this->__t('Usuarios')?></title>

    <?=$include_css?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div id="wrapper">
        <?=$menu?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?=$this->__t('Usuarios')?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <form class="form-horizontal" method="post" action="">
                        <input type="hidden" name="controlador" value="user">
                        <input type="hidden" name="accion" value="createUser">
                        <div class="form-group">
                            <label for="Email" class="col-sm-2 control-label"><?=$this->__t('Email')?></label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="Email" name="email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Username" class="col-sm-2 control-label"><?=$this->__t('Nombre de usuario')?></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="Username" name="username">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Password" class="col-sm-2 control-label"><?=$this->__t('Contraseña')?></label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="Password" name="password">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default"><?=$this->__t('Crear')?></button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->

    <?=$include_js?>
    <script>
        $("form").validate({
            rules: {
                email: {
                    required: true
                },
                username: {
                    required: true,
                    normalizer: function(value) {
                        return $.trim(value);
                    }
                },
                password: {
                    required: true
                }
            }
        });
        $('input').each(function(){
            $(this).rules('add', {
                messages: {
                    required: "Campo obligatorio",
                    email: "Introduzca un email valido"
                }
            });
        });
    </script>
</body>
</html>