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

/* core/themes/claro/templates/details.html.twig */
class __TwigTemplate_20ed3541379650843ad8b66ef30c7e93 extends Template
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
        // line 23
        $context["classes"] = ["claro-details", ((        // line 25
($context["accordion"] ?? null)) ? ("claro-details--accordion") : ("")), ((        // line 26
($context["accordion_item"] ?? null)) ? ("claro-details--accordion-item") : ("")), (((($__internal_compile_0 =         // line 27
($context["element"] ?? null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["#module_package_listing"] ?? null) : null)) ? ("claro-details--package-listing") : (""))];
        // line 31
        $context["content_wrapper_classes"] = ["claro-details__wrapper", "details-wrapper", ((        // line 34
($context["accordion"] ?? null)) ? ("claro-details__wrapper--accordion") : ("")), ((        // line 35
($context["accordion_item"] ?? null)) ? ("claro-details__wrapper--accordion-item") : ("")), (((($__internal_compile_1 =         // line 36
($context["element"] ?? null)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1["#module_package_listing"] ?? null) : null)) ? ("claro-details__wrapper--package-listing") : (""))];
        // line 40
        $context["inner_wrapper_classes"] = ["claro-details__content", ((        // line 42
($context["accordion"] ?? null)) ? ("claro-details__content--accordion") : ("")), ((        // line 43
($context["accordion_item"] ?? null)) ? ("claro-details__content--accordion-item") : ("")), (((($__internal_compile_2 =         // line 44
($context["element"] ?? null)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["#module_package_listing"] ?? null) : null)) ? ("claro-details__content--package-listing") : (""))];
        // line 47
        echo "<details";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", [($context["classes"] ?? null)], "method", false, false, true, 47), 47, $this->source), "html", null, true);
        echo ">";
        // line 48
        if (($context["title"] ?? null)) {
            // line 50
            $context["summary_classes"] = ["claro-details__summary", ((            // line 52
($context["required"] ?? null)) ? ("js-form-required") : ("")), ((            // line 53
($context["required"] ?? null)) ? ("form-required") : ("")), ((            // line 54
($context["accordion"] ?? null)) ? ("claro-details__summary--accordion") : ("")), ((            // line 55
($context["accordion_item"] ?? null)) ? ("claro-details__summary--accordion-item") : ("")), (((($__internal_compile_3 =             // line 56
($context["element"] ?? null)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3["#module_package_listing"] ?? null) : null)) ? ("claro-details__summary--package-listing") : (""))];
            // line 60
            echo "    <summary";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["summary_attributes"] ?? null), "addClass", [($context["summary_classes"] ?? null)], "method", false, false, true, 60), 60, $this->source), "html", null, true);
            echo ">";
            // line 61
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title"] ?? null), 61, $this->source), "html", null, true);
            // line 62
            if (($context["required"] ?? null)) {
                // line 63
                echo "<span class=\"required-mark\"></span>";
            }
            // line 65
            echo "</summary>";
        }
        // line 67
        echo "<div";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["content_attributes"] ?? null), "addClass", [($context["content_wrapper_classes"] ?? null)], "method", false, false, true, 67), 67, $this->source), "html", null, true);
        echo ">
    ";
        // line 68
        if ((($context["accordion"] ?? null) || ($context["accordion_item"] ?? null))) {
            // line 69
            echo "    <div";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->createAttribute(["class" => ($context["inner_wrapper_classes"] ?? null)]), "html", null, true);
            echo ">
    ";
        }
        // line 71
        echo "
      ";
        // line 72
        if (($context["errors"] ?? null)) {
            // line 73
            echo "        <div class=\"form-item form-item--error-message\">
          ";
            // line 74
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["errors"] ?? null), 74, $this->source), "html", null, true);
            echo "
        </div>
      ";
        }
        // line 77
        if (($context["description"] ?? null)) {
            // line 78
            echo "<div class=\"claro-details__description";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(((($context["disabled"] ?? null)) ? (" is-disabled") : ("")));
            echo "\">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["description"] ?? null), 78, $this->source), "html", null, true);
            echo "</div>";
        }
        // line 80
        if (($context["children"] ?? null)) {
            // line 81
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["children"] ?? null), 81, $this->source), "html", null, true);
        }
        // line 83
        if (($context["value"] ?? null)) {
            // line 84
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["value"] ?? null), 84, $this->source), "html", null, true);
        }
        // line 87
        if ((($context["accordion"] ?? null) || ($context["accordion_item"] ?? null))) {
            // line 88
            echo "    </div>
    ";
        }
        // line 90
        echo "  </div>
</details>
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["accordion", "accordion_item", "element", "attributes", "title", "required", "summary_attributes", "content_attributes", "errors", "description", "disabled", "children", "value"]);    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "core/themes/claro/templates/details.html.twig";
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
        return array (  133 => 90,  129 => 88,  127 => 87,  124 => 84,  122 => 83,  119 => 81,  117 => 80,  110 => 78,  108 => 77,  102 => 74,  99 => 73,  97 => 72,  94 => 71,  88 => 69,  86 => 68,  81 => 67,  78 => 65,  75 => 63,  73 => 62,  71 => 61,  67 => 60,  65 => 56,  64 => 55,  63 => 54,  62 => 53,  61 => 52,  60 => 50,  58 => 48,  54 => 47,  52 => 44,  51 => 43,  50 => 42,  49 => 40,  47 => 36,  46 => 35,  45 => 34,  44 => 31,  42 => 27,  41 => 26,  40 => 25,  39 => 23,);
    }

    public function getSourceContext()
    {
        return new Source("", "core/themes/claro/templates/details.html.twig", "/opt/drupal/web/core/themes/claro/templates/details.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 23, "if" => 48);
        static $filters = array("escape" => 47);
        static $functions = array("create_attribute" => 69);

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if'],
                ['escape'],
                ['create_attribute']
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
