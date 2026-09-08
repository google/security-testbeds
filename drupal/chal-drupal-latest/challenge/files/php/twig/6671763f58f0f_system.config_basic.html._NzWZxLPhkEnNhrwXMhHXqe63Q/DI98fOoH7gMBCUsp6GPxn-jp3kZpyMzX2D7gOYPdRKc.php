<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* @help_topics/system.config_basic.html.twig */
class __TwigTemplate_64dbef9d15db5d7faaac841673cf0160 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 7
        ob_start(function () { return ''; });
        echo t("Regional settings", array());
        $context["regional_link_text"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 8
        $context["regional_link"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getRouteLink($this->sandbox->ensureToStringAllowed(($context["regional_link_text"] ?? null), 8, $this->source), "system.regional_settings"));
        // line 9
        ob_start(function () { return ''; });
        echo t("Basic site settings", array());
        $context["information_link_text"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 10
        $context["information_link"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getRouteLink($this->sandbox->ensureToStringAllowed(($context["information_link_text"] ?? null), 10, $this->source), "system.site_information_settings"));
        // line 11
        ob_start(function () { return ''; });
        echo t("Date and time formats", array());
        $context["datetime_link_text"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 12
        $context["datetime_link"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getRouteLink($this->sandbox->ensureToStringAllowed(($context["datetime_link_text"] ?? null), 12, $this->source), "entity.date_format.collection"));
        // line 13
        echo "<h2>";
        echo t("Goal", array());
        echo "</h2>
<p>";
        // line 14
        echo t("Configure the basic settings of your site, including the site name, slogan, main email address, default time zone, default country, and the date formats to use.", array());
        echo "</p>
<h2>";
        // line 15
        echo t("Steps", array());
        echo "</h2>
<ol>
  <li>";
        // line 17
        echo t("In the <em>Manage</em> administrative menu, navigate to <em>Configuration</em> &gt; <em>System</em> &gt; <em>@information_link</em>.", array("@information_link" => ($context["information_link"] ?? null), ));
        echo "</li>
  <li>";
        // line 18
        echo t("Enter the site name, slogan, and main email address for your site.", array());
        echo "</li>
  <li>";
        // line 19
        echo t("Click <em>Save configuration</em>. You should see a message indicating that the settings were saved.", array());
        echo "</li>
  <li>";
        // line 20
        echo t("In the <em>Manage</em> administrative menu, navigate to <em>Configuration</em> &gt; <em>Region and language</em> &gt; <em>@regional_link</em>.", array("@regional_link" => ($context["regional_link"] ?? null), ));
        echo "</li>
  <li>";
        // line 21
        echo t("Select the default country and default time zone for your site.", array());
        echo "</li>
  <li>";
        // line 22
        echo t("Click <em>Save configuration</em>. You should see a message indicating that the settings were saved.", array());
        echo "</li>
  <li>";
        // line 23
        echo t("In the <em>Manage</em> administrative menu, navigate to <em>Configuration</em> &gt; <em>Region and language</em> &gt; <em>@datetime_link</em>.", array("@datetime_link" => ($context["datetime_link"] ?? null), ));
        echo "</li>
  <li>";
        // line 24
        echo t("Look at the <em>Patterns</em> for the Default long, medium, and short date formats. If any of them does not match the date format you want to use on your site, click <em>Edit</em> in that row to edit the format.", array());
        echo "</li>
  <li>";
        // line 25
        echo t("Adjust the <em>Format string</em> until the <em>Displayed</em> format matches what you want. (Date format strings are composed of PHP date format codes.)", array());
        echo "</li>
  <li>";
        // line 26
        echo t("Click <em>Save format</em>. You should see a message indicating that the format was saved.", array());
        echo "</li>
  <li>";
        // line 27
        echo t("Repeat the previous three steps for any other date formats that need to be changed.", array());
        echo "</li>
</ol>
<h2>";
        // line 29
        echo t("Additional resources", array());
        echo "</h2>
<p>";
        // line 30
        echo t("<a href=\"https://www.php.net/manual/datetime.format.php#refsect1-datetime.format-parameters\">PHP date format codes reference</a>", array());
        echo "</p>";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@help_topics/system.config_basic.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable()
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo()
    {
        return array (  120 => 30,  116 => 29,  111 => 27,  107 => 26,  103 => 25,  99 => 24,  95 => 23,  91 => 22,  87 => 21,  83 => 20,  79 => 19,  75 => 18,  71 => 17,  66 => 15,  62 => 14,  57 => 13,  55 => 12,  51 => 11,  49 => 10,  45 => 9,  43 => 8,  39 => 7,);
    }

    public function getSourceContext()
    {
        return new Source("", "@help_topics/system.config_basic.html.twig", "/opt/drupal/web/core/modules/system/help_topics/system.config_basic.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 7, "trans" => 7);
        static $filters = array("escape" => 17);
        static $functions = array("render_var" => 8, "help_route_link" => 8);

        try {
            $this->sandbox->checkSecurity(
                ['set', 'trans'],
                ['escape'],
                ['render_var', 'help_route_link']
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
