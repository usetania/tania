<?php

/* @FOSUser/layout.html.twig */
class __TwigTemplate_9d0978830e10e1050f5704f21af8c77ca512bab26f0059d48121ed2f7f3bc92e extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'fos_user_content' => array($this, 'block_fos_user_content'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"utf-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"description\" content=\"\">
    <meta name=\"author\" content=\"\">
    <link rel=\"shortcut icon\" href=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("assets/img/favicon.png"), "html", null, true);
        echo "\">

    <title>";
        // line 11
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
    
    ";
        // line 13
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 18
        echo "
    <!--[if lt IE 9]>
    <script src=\"https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js\"></script>
    <script src=\"https://oss.maxcdn.com/respond/1.4.2/respond.min.js\"></script>
    <![endif]-->
</head>
<body class=\"tania-splash\">
    ";
        // line 25
        $this->displayBlock('fos_user_content', $context, $blocks);
        // line 26
        echo "
    ";
        // line 27
        $this->displayBlock('javascripts', $context, $blocks);
        // line 28
        echo "</body>
</html>";
    }

    // line 11
    public function block_title($context, array $blocks = array())
    {
        echo "TANIA";
    }

    // line 13
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 14
        echo "    <link rel=\"stylesheet\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("assets/css/style.css"), "html", null, true);
        echo "\" type=\"text/css\"/>
    <link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 15
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("assets/css/material-design-icons/css/material-design-iconic-font.min.css"), "html", null, true);
        echo "\"/>
    <link rel=\"stylesheet\" href=\"";
        // line 16
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("assets/css/tania.css"), "html", null, true);
        echo "\" type=\"text/css\"/>
    ";
    }

    // line 25
    public function block_fos_user_content($context, array $blocks = array())
    {
    }

    // line 27
    public function block_javascripts($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "@FOSUser/layout.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  95 => 27,  90 => 25,  84 => 16,  80 => 15,  75 => 14,  72 => 13,  66 => 11,  61 => 28,  59 => 27,  56 => 26,  54 => 25,  45 => 18,  43 => 13,  38 => 11,  33 => 9,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@FOSUser/layout.html.twig", "/var/www/symfony/app/Resources/FOSUserBundle/views/layout.html.twig");
    }
}
