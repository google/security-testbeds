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

/* @help_topics/core.ui_accessibility.html.twig */
class __TwigTemplate_44e310fb60343460732b77c6aff7b4d5 extends Template
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
        // line 6
        echo "<h2>";
        echo t("Overview of accessibility", array());
        echo "</h2>
<p>";
        // line 7
        echo t("The core administrative interface has built-in compliance with many accessibility standards so that most pages are accessible to most users in their default state. However, certain pages become more accessible to some users through the use of a non-default or improved interface. These interfaces include:", array());
        echo "</p>
<dl>
  <dt>";
        // line 9
        echo t("Disabling drag-and-drop functionality", array());
        echo "</dt>
  <dd>";
        // line 10
        echo t("The default drag-and-drop user interface for ordering tables in the administrative interface presents a challenge for some users, including keyboard-only users and users of screen readers and other assistive technology. The drag-and-drop interface can be disabled in a table by clicking a link labeled <em>Show row weights</em> above the table. The replacement interface allows users to order the table by choosing numerical weights (with increasing numbers) instead of dragging table rows.", array());
        echo "</dd>
  <dt>";
        // line 11
        echo t("Enabling inline form errors", array());
        echo "</dt>
  <dd>";
        // line 12
        echo t("Errors that occur when you submit a form, such as not filling in a required field, are sometimes difficult for users to understand and locate. In order to make these errors easier to find, the best practice is to put a summary of the errors at the top of the form page. To make them easier to understand, the best practice is to display error messages with the form fields they are related to. Both of these practices are implemented by the core Inline Form Errors module.", array());
        echo "</dd>
</dl>";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@help_topics/core.ui_accessibility.html.twig";
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
        return array (  61 => 12,  57 => 11,  53 => 10,  49 => 9,  44 => 7,  39 => 6,);
    }

    public function getSourceContext()
    {
        return new Source("", "@help_topics/core.ui_accessibility.html.twig", "/opt/drupal/web/core/modules/help/help_topics/core.ui_accessibility.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("trans" => 6);
        static $filters = array();
        static $functions = array();

        try {
            $this->sandbox->checkSecurity(
                ['trans'],
                [],
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
