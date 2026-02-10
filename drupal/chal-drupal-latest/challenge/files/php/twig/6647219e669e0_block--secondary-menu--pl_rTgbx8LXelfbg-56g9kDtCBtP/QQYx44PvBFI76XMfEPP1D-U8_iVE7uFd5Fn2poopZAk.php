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

/* core/themes/olivero/templates/block/block--secondary-menu--plugin-id--search-form-block.html.twig */
class __TwigTemplate_665f829f59752748dd562f187fe089ee extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'content' => [$this, 'block_content'],
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 26
        $context["classes"] = ["block", "block-search-wide"];
        // line 31
        echo "<div";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", [($context["classes"] ?? null)], "method", false, false, true, 31), 31, $this->source), "html", null, true);
        echo ">
  ";
        // line 32
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title_prefix"] ?? null), 32, $this->source), "html", null, true);
        echo "
  ";
        // line 33
        if (($context["label"] ?? null)) {
            // line 34
            echo "    <h2";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title_attributes"] ?? null), 34, $this->source), "html", null, true);
            echo ">";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["label"] ?? null), 34, $this->source), "html", null, true);
            echo "</h2>
  ";
        }
        // line 36
        echo "  ";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["title_suffix"] ?? null), 36, $this->source), "html", null, true);
        echo "
  ";
        // line 37
        $this->displayBlock('content', $context, $blocks);
        // line 56
        echo "</div>
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["attributes", "title_prefix", "label", "title_attributes", "title_suffix", "content_attributes", "content"]);    }

    // line 37
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 38
        echo "    <button class=\"block-search-wide__button\" aria-label=\"";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Search Form"));
        echo "\" data-drupal-selector=\"block-search-wide-button\">
      ";
        // line 39
        $this->loadTemplate("@olivero/../images/search.svg", "core/themes/olivero/templates/block/block--secondary-menu--plugin-id--search-form-block.html.twig", 39)->display($context);
        // line 40
        echo "      <span class=\"block-search-wide__button-close\"></span>
    </button>

    ";
        // line 48
        echo "    <div";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["content_attributes"] ?? null), "addClass", ["block-search-wide__wrapper"], "method", false, false, true, 48), "setAttribute", ["data-drupal-selector", "block-search-wide-wrapper"], "method", false, false, true, 48), "setAttribute", ["tabindex", "-1"], "method", false, false, true, 48), 48, $this->source), "html", null, true);
        echo ">
      <div class=\"block-search-wide__container\">
        <div class=\"block-search-wide__grid\">
          ";
        // line 51
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(($context["content"] ?? null), 51, $this->source), "html", null, true);
        echo "
        </div>
      </div>
    </div>
  ";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "core/themes/olivero/templates/block/block--secondary-menu--plugin-id--search-form-block.html.twig";
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
        return array (  97 => 51,  90 => 48,  85 => 40,  83 => 39,  78 => 38,  74 => 37,  68 => 56,  66 => 37,  61 => 36,  53 => 34,  51 => 33,  47 => 32,  42 => 31,  40 => 26,);
    }

    public function getSourceContext()
    {
        return new Source("", "core/themes/olivero/templates/block/block--secondary-menu--plugin-id--search-form-block.html.twig", "/opt/drupal/web/core/themes/olivero/templates/block/block--secondary-menu--plugin-id--search-form-block.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 26, "if" => 33, "block" => 37, "include" => 39);
        static $filters = array("escape" => 31, "t" => 38);
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['set', 'if', 'block', 'include'],
                ['escape', 't'],
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
