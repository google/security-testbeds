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

/* core/modules/system/templates/form-element-label.html.twig */
class __TwigTemplate_cd2fc39c8b9c520991113c4d5b7bf40a extends Template
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
        // line 18
        $context["classes"] = [(((        // line 19
($context["title_display"] ?? null) == "after")) ? ("option") : ("")), (((        // line 20
($context["title_display"] ?? null) == "invisible")) ? ("visually-hidden") : ("")), ((        // line 21
($context["required"] ?? null)) ? ("js-form-required") : ("")), ((        // line 22
($context["required"] ?? null)) ? ("form-required") : (""))];
        // line 25
        if (( !twig_test_empty(($context["title"] ?? null)) || ($context["required"] ?? null))) {
            // line 26
            echo "<label";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", [($context["classes"] ?? null)], "method", false, false, true, 26), 26, $this->source), "html", null, true);
            echo ">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title"] ?? null), 26, $this->source), "html", null, true);
            echo "</label>";
        }
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["title_display", "required", "title", "attributes"]);    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "core/modules/system/templates/form-element-label.html.twig";
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
        return array (  47 => 26,  45 => 25,  43 => 22,  42 => 21,  41 => 20,  40 => 19,  39 => 18,);
    }

    public function getSourceContext()
    {
        return new Source("", "core/modules/system/templates/form-element-label.html.twig", "/opt/drupal/web/core/modules/system/templates/form-element-label.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 18, "if" => 25);
        static $filters = array("escape" => 26);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if'],
                ['escape'],
                []
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
