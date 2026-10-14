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

/* @help_topics/system.module_install.html.twig */
class __TwigTemplate_60d825c1c7b4b1889b5ff8aeea3c9b7f extends Template
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
        echo t("Extend", array());
        $context["extend_link_text"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 8
        $context["extend_link"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getRouteLink($this->sandbox->ensureToStringAllowed(($context["extend_link_text"] ?? null), 8, $this->source), "system.modules_list"));
        // line 9
        echo "<h2>";
        echo t("Goal", array());
        echo "</h2>
<p>";
        // line 10
        echo t("Install a core module, or a contributed module that has already been downloaded.", array());
        echo "</p>
<h2>";
        // line 11
        echo t("Steps", array());
        echo "</h2>
<ol>
  <li>";
        // line 13
        echo t("In the <em>Manage</em> administrative menu, navigate to <em>@extend_link</em>.", array("@extend_link" => ($context["extend_link"] ?? null), ));
        echo "</li>
  <li>";
        // line 14
        echo t("Enter a word from the module name or description into the filter box, to make the list of modules smaller. Locate the module you want to install.", array());
        echo "</li>
  <li>";
        // line 15
        echo t("Check the box next to the name of the module you want to install; you can also check more than one box to install multiple modules at the same time. If the checkbox is disabled for the module you are trying to install, expand the information to see why -- you may need to download an additional module that your module requires.", array());
        echo "</li>
  <li>";
        // line 16
        echo t("Click <em>Install</em> at the bottom of the page. If you chose to install a module with dependencies that were not already installed, or if you chose an Experimental module, confirm your choice on the next page.", array());
        echo "</li>
  <li>";
        // line 17
        echo t("Wait for the module (or modules) to be installed. You should be returned to the <em>Extend</em> page with a message saying the module or modules were installed.", array());
        echo "</li>
</ol>";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@help_topics/system.module_install.html.twig";
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
        return array (  75 => 17,  71 => 16,  67 => 15,  63 => 14,  59 => 13,  54 => 11,  50 => 10,  45 => 9,  43 => 8,  39 => 7,);
    }

    public function getSourceContext()
    {
        return new Source("", "@help_topics/system.module_install.html.twig", "/opt/drupal/web/core/modules/system/help_topics/system.module_install.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 7, "trans" => 7);
        static $filters = array("escape" => 13);
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
