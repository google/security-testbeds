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

/* core/themes/olivero/templates/block/block--system-powered-by-block.html.twig */
class __TwigTemplate_a769bccbe8032002f2c38f1c198c76da extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'content' => [$this, 'block_content'],
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $this->checkSecurity();
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "block.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("block.html.twig", "core/themes/olivero/templates/block/block--system-powered-by-block.html.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 12
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 13
        echo "  ";
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->attachLibrary("olivero/powered-by-block"), "html", null, true);
        echo "
  <span>
    ";
        // line 15
        echo t("Powered by", array());
        // line 16
        echo "    <a href=\"https://www.drupal.org\">";
        echo t("Drupal", array());
        echo "</a>
    <span class=\"drupal-logo\" role=\"img\" aria-label=\"";
        // line 17
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Drupal Logo"));
        echo "\">
      ";
        // line 18
        $this->loadTemplate("@olivero/../images/drupal.svg", "core/themes/olivero/templates/block/block--system-powered-by-block.html.twig", 18)->display($context);
        // line 19
        echo "    </span>
  </span>
";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "core/themes/olivero/templates/block/block--system-powered-by-block.html.twig";
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
        return array (  71 => 19,  69 => 18,  65 => 17,  60 => 16,  58 => 15,  52 => 13,  48 => 12,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "core/themes/olivero/templates/block/block--system-powered-by-block.html.twig", "/opt/drupal/web/core/themes/olivero/templates/block/block--system-powered-by-block.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("trans" => 15, "include" => 18);
        static $filters = array("escape" => 13, "t" => 17);
        static $functions = array("attach_library" => 13);

        try {
            $this->sandbox->checkSecurity(
                ['trans', 'include'],
                ['escape', 't'],
                ['attach_library']
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
