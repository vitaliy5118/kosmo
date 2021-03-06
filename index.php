<?php

//����� ������ 
$config = array (
    'userSite' => 'kosmo.in.ua',
    'userEmail' => 'vitaliy5118@meta.ua',
    'userPhone_1' => '+38(093) 916-91-39',
    'userPhone_2' => '+38(097) 720-95-34',
    'userVK_1' => 'https://vk.com/labya4ka',
    'userVK_2' => 'https://vk.com/liliya002',
    'userFB_1' => 'https://www.facebook.com/profile.php?id=100000729912183&fref=ts',
    'userFB_2' => 'https://www.facebook.com/liliya.tsiukh',
    'userSkype' => 'KosmoBeaty',
    'userVkGroup' => 'KosmoBeaty',
    'userAdressCity' => '�. ������������',
    'userAdressStr' => '���. ���������� 62, 2-� ������',
    'userNames' => '�����, ˳��'
    );

class messageControl {

    public $name;
    public $email;
    public $phone;
    public $message;

    public function __construct($post_array) {
        $this->name    = self::filter($post_array['name']);
        $this->email   = self::filter($post_array['email']);
        $this->phone   = self::filter($post_array['phone']);
        $this->message = self::filter($post_array['message']);
    }
    
    //�������� �������� ������
    public function checkRegex() {
        //�������� ���������� ���������
        if (!preg_match("/^[�-��-�A-Za-z0-9 \.\,\-\ \!\;\:]{2,20}$/i", $this->name)) {
            $error['name'] = 'error';
        }
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $error['email'] = 'error';
        }
        if (!preg_match("/^[0-9 \+\(\)]{3,20}$/i", $this->phone)) {
            $error['phone'] = 'error';
        }
        if (!preg_match("/^[�-��-�A-Za-z0-9 \.\,\-\ \!\;\:]{3,300}$/i", $this->message)) {
            $error['message'] = 'error';
        }
        
        return $error;
    }
    
    //������ �������� ������ 
    public static function filter($data) {
        $quotes = array("\x27", "\x22", "\x60", "\t", "\n", "\r", "*", "%", "<", ">", "?", "!", "#","/","\\");
        $text = trim(strip_tags($data));
        $text = str_replace($quotes, '', $text);
        
        return $text;
    }

}

if (isset($_POST['name']) && isset($_POST['email'])) {
    
    $message = new messageControl($_POST);
    $error = $message->checkRegex();
    
    if (!$error){
        //������ �������� ����
        $to = $config['userEmail'];

        $subject = "��������� � ����� ";

        $userMessage = "
        <html> 
            <head> 
                <title>��������� � ����� </title> 
            </head> 
            <body> 
                <p>���: $message->name</p> 
                <p>�������: $message->phone</p> 
                <p>email: $message->email</p> 
                <p>���������: $message->message</p> 
            </body> 
        </html>";

        $headers = "Content-type: text/html; charset=windows-1251 \r\n";
        $headers .= "From: {$config['userSite']}";

        mail($to, $subject, $userMessage, $headers);
        
        header("Location: /?message=true");
        
    }else{
        //������ ��������
        $name = $message->name;
        $email = $message->email;
        $phone = $message->phone;
        $userMessage = $message->message;
        
        //������ ��������, ��������� ���������� ����� ������� GET
        header("Location: /?form=true&name=$name&email=$email&phone=$phone&message=$userMessage&end=true/#contact");
    }
}

//������ ��������, ��������� ���������� �����
if (isset($_GET['form']) && $_GET['form']=='true') {
        
        $message = new messageControl($_GET);
        $error = $message->checkRegex();
        
        //������ ��������
        $name = $message->name;
        $email = $message->email;
        $phone = $message->phone;
        $userMessage = $message->message;
        
        $sendMessage = '����������� �� ����������!';
}

//��������� �� �������� �������� ������
if (isset($_GET['message']) && $_GET['message']=='true') {
    $succesfull = "<span class='shadow'><b>���� ��������� ������� ����������</b></span>";
}

?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="windows-1251">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="���������� ���������� � �.�������������">
        <meta name="keywords" content="����������, ������ �����������, ���������� ������������, ��������� CHRISTINA, �������, ������ ����" /> 
        <meta name="author" content="">

        <title>���������� ���������� � �.������������� +38(093) 916-91-39  +38(097) 720-95-34</title>
        <link rel="shortcut icon" href="/img/icon.png">
        <!-- Bootstrap Core CSS -->
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

        <!-- Plugin CSS -->
        <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

        <!-- Theme CSS -->
        <link href="css/creative.css" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
       
    </head>

    <body id="page-top">

        <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand page-scroll" href="#page-top">���������� ���������� +38(093) 916-91-39  +38(097) 720-95-34 �.������������</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a class="page-scroll" href="#about">��� ���</a>
                        </li>
                        <li>
                            <a class="page-scroll" href="#services">�������</a>
                        </li>
                        <li>
                            <a class="page-scroll" href="#portfolio">����</a>
                        </li>
                        <li>
                            <a class="page-scroll" href="#contact">��������</a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>

        <header>
            <div class="header-content">
                <div class="header-content-inner">
                    <h1 id="homeHeading" class="shadow">����� ���� ������� ����� �� ����: ���� � ���� ���� ����</h1>
                    <hr>
                    <p><? if($succesfull) echo $succesfull; else echo ("\"KOKO CHANEL\""); ?></p>
                    <a href="#about" class="btn btn-primary btn-xl page-scroll">������������� �������</a>
                    <p class="text-faded" style="color: #2F4F4F;">
                        <br>
                        <strong><?=$config['userPhone_1']?>&nbsp;&nbsp;<?=$config['userPhone_2']?></strong><br>
                        <?=$config['userAdressCity']?>,&nbsp;<?=$config['userAdressStr']?>
                    </p>
                </div>
            </div>
        </header>

        <section class="bg-primary" id="about">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-lg-offset-2 text-center" >
                        <h2 class="section-heading">�� ������ ��� ���������</h2>
                        <hr class="light">
                        <p class="text-faded shadow">
                            �� �� ��� ������� ������ ��������� ������ ��������� ������� � ������������� ����������.<br>
                            �� ������� ���������� ���� �������, ������� ����, ��������� �'������ �����.
                        </p>
                        <p class="text-faded shadow">
                            ��������� ����� ���������� ��� �� ���� ������� ������ ������� ��������� ��������� �����������.
                            ���� ������� ����������� - �� ��������� �� ����� ����������, ��� � ��������� �� �������� � ����.
                            �� ���� �����, ��������� �� ������ ����� ��� ������� ����, �� ��������� �������� � ���������� ���������� ��� ��� �� ����� �������� �������� �������.
                            �� ���������� ������ ������� �����, ������� ��� ��������� ����������, �������� �������� � ������� ���������.
                        </p>
                        <p class="text-faded shadow">
                            ���������� ������ �� ����� �������� ������� � �������� �� ��������.
                            ������� ����������� ��������� �������������� ��������, ������� ������� �������� ����, ������� ����-��� ����� �������.
                            ������ ������� � ������, �������� ���������, ������������� ���������, ������� ����������, ������������ ���� � ������� - ������ �� ���������!
                        </p>
                        <a href="#services" class="btn btn-default btn-xl page-scroll">���� �������</a>
                    </div>
                </div>
            </div>
        </section>

<!--******************** <section id="services"> *******************************************************************-->

        <section class="bg_services" id="services">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="section-heading">�� ����� ������</h2>
                        <hr><br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                      
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <table class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline" id="dataTables-example" role="grid" aria-describedby="dataTables-example_info" style="width: 100%;" width="100%">

                                    <tbody>
                                        <tr role="row">
                                            <td> 1.</td>
                                            <td>������������  �����������  <b>�����������</b> <br></td>
                                        </tr>
                                        <tr role="row">
                                            <td> 2.</td>
                                            <td> ��������� ������ �������</td>
                                        </tr>
                                        <tr role="row">
                                            <td> 3.</td>
                                            <td> ��������� ������ �����</td>
                                        </tr>
                                        <tr role="row">
                                            <td> 4.</td>
                                            <td>���������� ��������� �� ������� �� �������� �� ��������� "CHRISTINA"<br>
                                                - ������ �� �������� ����� <br>
                                                - ������ �� ����� � �������� �������� <br>
                                                - ������ �� ���������� � ������ ����� <br>
                                                - ������ �� ����� �������� �� ���������� <br>
                                                - ������ �� ����� �������� �� ������� (������������) <br>
                                                - ������ �� ����� � ����������� ����� <br>
                                                - ������ �� ����� � ������� �������� ������� <br>
                                                - Anti-age ������ � ������� ������� <br>
                                                - ������������ ������ <br>
                                                - ������ �� �������� ����
                                            </td>
                                        </tr>
                                        <tr role="row">
                                            <td> 5.</td>
                                            <td> ϳ��� "CHRISTINA"</td>
                                        </tr>
                                        <tr role="row">
                                            <td> 6.</td>
                                            <td> �����<br>
                                                -��������� ����� � ������������� ��������� (�������, ���, ��������) <br>
                                                -���������� ����� (�������, ���, ��������) <br>
                                                -���������� ����� �� ���� <br>
                                                -������������� ����� (�������, ���, ��������)
                                            </td>
                                        </tr>
                                        <tr role="row">
                                            <td> 7.</td>
                                            <td> �����<br>
                                                - ��������� ���������� ����� - ������������� ����� � ������ ��������� ������������, <br>
                                                �� ������������ ����� ���������� � �������� ������� ���� ����
                                            </td>
                                        </tr>
                                        <tr role="row">
                                            <td> 8.</td>
                                            <td> ��������������</td>
                                        </tr>
                                        <tr role="row">
                                            <td> 9.</td>
                                            <td> �������� (������ ����, ���, ���, ���� ����, ������ ���� ������, ���� ����)</td>
                                        </tr>
                                        <tr role="row">
                                            <td> 10.</td>
                                            <td> �������� ����� ���, ���������� ���, ��</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="no-padding" id="portfolio">
            <div class="container-fluid">
                <div class="row no-gutter popup-gallery">
                    <div class="col-lg-4 col-sm-6">
                        <a href="img/portfolio/photo/1.jpg" class="portfolio-box" >

                            <img src="img/portfolio/thumbnails/1.jpg" class="img-responsive" alt="" >
                            <div class="portfolio-box-caption">
                                <div class="portfolio-box-caption-content">
                                    <div class="project-category text-faded">
                                        ���� ������
                                    </div>
                                    <div class="project-name">
                                        ����������
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a href="img/portfolio/photo/2.jpg" class="portfolio-box">
                            <img src="img/portfolio/thumbnails/2.jpg" class="img-responsive" alt="">
                            <div class="portfolio-box-caption">
                                <div class="portfolio-box-caption-content">
                                    <div class="project-category text-faded">
                                        ������ ��������� "CHRISTINA"
                                    </div>
                                    <div class="project-name">
                                        ����������
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a href="img/portfolio/photo/3.jpg" class="portfolio-box">
                            <img src="img/portfolio/thumbnails/3.jpg" class="img-responsive" alt="">
                            <div class="portfolio-box-caption">
                                <div class="portfolio-box-caption-content">
                                    <div class="project-category text-faded">
                                        ������ ��������
                                    </div>
                                    <div class="project-name">
                                        ����������
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a href="img/portfolio/photo/4.jpg" class="portfolio-box">
                            <img src="img/portfolio/thumbnails/4.jpg" class="img-responsive" alt="">
                            <div class="portfolio-box-caption">
                                <div class="portfolio-box-caption-content">
                                    <div class="project-category text-faded">
                                        ��������� ���������
                                    </div>
                                    <div class="project-name">
                                        ����������
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a href="img/portfolio/photo/5.jpg" class="portfolio-box">
                            <img src="img/portfolio/thumbnails/5.jpg" class="img-responsive" alt="">
                            <div class="portfolio-box-caption">
                                <div class="portfolio-box-caption-content">
                                    <div class="project-category text-faded">
                                        �������� ����
                                    </div>
                                    <div class="project-name">
                                        ����������
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <a href="img/portfolio/photo/6.jpg" class="portfolio-box">
                            <img src="img/portfolio/thumbnails/6.jpg" class="img-responsive" alt="">
                            <div class="portfolio-box-caption">
                                <div class="portfolio-box-caption-content">
                                    <div class="project-category text-faded">
                                        ������ �����
                                    </div>
                                    <div class="project-name">
                                        ����������
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="img/portfolio/photo/7.jpg" class="portfolio-box"></a>
                        <a href="img/portfolio/photo/8.jpg" class="portfolio-box"></a>
                        <a href="img/portfolio/photo/9.jpg" class="portfolio-box"></a>
                        <a href="img/portfolio/photo/10.jpg" class="portfolio-box"></a>
                        <a href="img/portfolio/photo/11.jpg" class="portfolio-box"></a>
                        <a href="img/portfolio/photo/12.jpg" class="portfolio-box"></a>
                        <a href="img/portfolio/photo/13.jpg" class="portfolio-box"></a>
                        <a href="img/portfolio/photo/14.jpg" class="portfolio-box"></a>
                        <a href="img/portfolio/photo/15.jpg" class="portfolio-box"></a>
                        <a href="img/portfolio/photo/16.jpg" class="portfolio-box"></a>
                    </div>
                </div>
            </div>
        </section>

        <aside class="bg-dark">
            <div class="container text-center">
                <div class="call-to-action">
                    <h2>³���� ���� ��������� �����, �������� �� ������</h2>
                    <a href="#contact" class="btn btn-default btn-xl sr-button page-scroll">���������� �� ������</a>
                </div>
            </div>
        </aside>

        <section id="contact">
            <div class="container">
                <div class="row">
                    <div class="section-title text-center">
                        <h3>��������� ������</h3>
                        <p>��� ��'���� � ���� ��������� ����� ��� �������������</p>
                    </div>
                </div>
                <div class="row">

                    <div class="col-md-4">
                        <div class="footer-contact-info">
                            <h4>��������� ����������</h4>
                            <ul>
                                <li><strong>E-mail :</strong> <?=$config['userEmail']?></li>
                                <li><strong>������� :</strong> <?=$config['userPhone_1']?></li>
                                <li><strong>������� :</strong> <?=$config['userPhone_2']?></li>
                                <li><strong>�������� ����� :</strong>  <?=$config['userNames']?></li>
                                <li><strong>Skype:</strong> <?=$config['userSkype']?></li>
                                <li><strong>Vk:</strong> <?=$config['userVkGroup']?></li>
                                <li><strong>Viber:</strong> <?=$config['phone_1']?></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="footer-social text-center">
                            <ul style="margin-left: -40px;">
                                <li><a href="<?=$config['userVK_1']?>"><i class="fa fa-vk"></i></a></li>
                                <li><a href="<?=$config['userFB_1']?>"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="<?=$config['userVK_1']?>"><i class="fa fa-vk"></i></a></li>
                                <li><a href="<?=$config['userFB_2']?>"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="<?=$config['userEmail']?>"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="footer-contact-info">
                            <h4>���� ������</h4>
                            <ul>
                                <li><strong>��-�� :</strong> � 9:00 �� 20:00</li>
                                <li><strong>��-�� :</strong> � 9:00 �� 20:00</li>
                                <li><strong>��� :</strong> �� ������</li>
                                <li><strong>�� :</strong> �� ������</li>
                            </ul>
                            <strong>������ ������:</strong>
                            <br><?=$config['userAdressCity']?>
                            <br><?=$config['userAdressStr']?>
                            <br>
                        </div>
                    </div>
                </div>
                <div class="row" style="padding-top: 80px;">
                    <div class="col-md-12">
                        <form name="sentMessage" id="contactForm" action="index.php" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input class="form-control <?=$error['name'];?>" placeholder="���� ��'� *" id="name" required="" data-validation-required-message="Please enter your name." name="name" value="<?=$name;?>" type="text" >
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control  <?=$error['email'];?>" placeholder="��� email *" id="email" required="" data-validation-required-message="Please enter your email address." name="email"   value="<?=$email;?>" type="email">
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control <?=$error['phone'];?>" placeholder="��� ������� *" id="phone" required="" data-validation-required-message="Please enter your phone number."  name="phone" value="<?=$phone;?>" type="tel">
                                        <p class="help-block text-danger error"></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <textarea class="form-control <?=$error['message'];?>" placeholder="������ ������� *" id="message" required="" data-validation-required-message="Please enter a message."   name="message"> <?=$userMessage;?> </textarea>
                                        <p class="help-block text-danger"></p>
                                    </div>
                                    <div class="form-group">
                                        <p class="help-block text-danger" style="color:red;"><?=$sendMessage?></p>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-lg-12 text-center">
                                    <div id="success"></div>
                                    <button type="submit" class="btn btn-primary">��������� ���������</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- jQuery -->
        <script src="vendor/jquery/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

        <!-- Plugin JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
        <script src="vendor/scrollreveal/scrollreveal.min.js"></script>
        <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

        <!-- Theme JavaScript -->
        <script src="js/creative.js"></script>
        
       </body>

</html>


