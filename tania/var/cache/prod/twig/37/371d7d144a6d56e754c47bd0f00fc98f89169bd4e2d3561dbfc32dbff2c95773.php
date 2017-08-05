<?php

/* @FOSUser/Security/login_content.html.twig */
class __TwigTemplate_f957106bdc163d1242fb5a77d330674a7f5fce435393ba23c782207dbffe2d1c extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 2
        echo "
<div class=\"be-wrapper\">
    <div class=\"be-content\">
        <div class=\"main-content container-fluid\">
            <div class=\"row tania\">
                <div class=\"col-md-6 col-xs-12\">
                    <img src=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\AssetExtension')->getAssetUrl("assets/img/tania.png"), "html", null, true);
        echo "\" class=\"tania-img\">
                    <h2>MANAGE FARMS EASIER &amp; SMARTER</h2>
                    <p>This impressive and modern farm management application will help you to manage the operations of your farm in a more intuitive, collaborative, and efficient way.</p>
                </div>
                <div class=\"col-md-6 col-xs-12 loginform\">
                    <form action=\"";
        // line 13
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("fos_user_security_check");
        echo "\" method=\"post\">
                        <span class=\"splash-title xs-pb-20\">Sign In to start working.</span>
                        ";
        // line 15
        if (($context["error"] ?? null)) {
            // line 16
            echo "                            <div class=\"alert alert-danger\" role=\"alert\">";
            echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans(twig_get_attribute($this->env, $this->getSourceContext(), ($context["error"] ?? null), "messageKey", array()), twig_get_attribute($this->env, $this->getSourceContext(), ($context["error"] ?? null), "messageData", array()), "security"), "html", null, true);
            echo "</div>
                        ";
        }
        // line 18
        echo "                        ";
        if (($context["csrf_token"] ?? null)) {
            // line 19
            echo "                            <input type=\"hidden\" name=\"_csrf_token\" value=\"";
            echo twig_escape_filter($this->env, ($context["csrf_token"] ?? null), "html", null, true);
            echo "\" />
                        ";
        }
        // line 21
        echo "                        <div class=\"form-group\">
                            <label for=\"username\">";
        // line 22
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("security.login.username", array(), "FOSUserBundle"), "html", null, true);
        echo "</label>
                            <input type=\"text\" id=\"username\" name=\"_username\" value=\"";
        // line 23
        echo twig_escape_filter($this->env, ($context["last_username"] ?? null), "html", null, true);
        echo "\" required=\"required\" class=\"form-control\" />
                        </div>
                        <div class=\"form-group\">
                            <label for=\"password\">";
        // line 26
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("security.login.password", array(), "FOSUserBundle"), "html", null, true);
        echo "</label>
                            <input type=\"password\" id=\"password\" name=\"_password\" required=\"required\" class=\"form-control\" />
                        </div>
                        <div class=\"form-group\">
                            <input type=\"checkbox\" id=\"remember_me\" name=\"_remember_me\" value=\"on\" />
                            <label for=\"remember_me\">";
        // line 31
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("security.login.remember_me", array(), "FOSUserBundle"), "html", null, true);
        echo "</label>
                        </div>
                        <div class=\"form-group xs-pt-10\">
                            <input type=\"submit\" id=\"_submit\" name=\"_submit\" value=\"";
        // line 34
        echo twig_escape_filter($this->env, $this->env->getExtension('Symfony\Bridge\Twig\Extension\TranslationExtension')->trans("security.login.submit", array(), "FOSUserBundle"), "html", null, true);
        echo "\" class=\"btn btn-block btn-primary btn-xl\" />
                        </div>
                        <div class=\"form-group col-xs-12 forgot-link\">
                            <a href=\"";
        // line 37
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("fos_user_resetting_request");
        echo "\">I forgot my password</a>
                        </div>
                        <div class=\"form-group col-xs-12\">
                            <p>Have no account? <a href=\"";
        // line 40
        echo $this->env->getExtension('Symfony\Bridge\Twig\Extension\RoutingExtension')->getPath("fos_user_registration_register");
        echo "\">Sign Up</a> here.</p>
                        </div>
                    </form>
                </div>
            </div>
            <div class=\"row\">
                <div class=\"tania-footer\">&copy; 2017 Tania. Build for the ♥︎ of plants.</div>
            </div>
        </div>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "@FOSUser/Security/login_content.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  96 => 40,  90 => 37,  84 => 34,  78 => 31,  70 => 26,  64 => 23,  60 => 22,  57 => 21,  51 => 19,  48 => 18,  42 => 16,  40 => 15,  35 => 13,  27 => 8,  19 => 2,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "@FOSUser/Security/login_content.html.twig", "/var/www/symfony/app/Resources/FOSUserBundle/views/Security/login_content.html.twig");
    }
}
