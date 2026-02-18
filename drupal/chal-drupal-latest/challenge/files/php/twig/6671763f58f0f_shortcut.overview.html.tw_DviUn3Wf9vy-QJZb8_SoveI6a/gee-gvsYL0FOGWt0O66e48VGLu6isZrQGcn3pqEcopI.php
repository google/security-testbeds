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

/* @help_topics/shortcut.overview.html.twig */
class __TwigTemplate_cb2d592d748b455fbd5ff53b781b24e1 extends Template
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
        echo t("Goal", array());
        echo "</h2>
<p>";
        // line 7
        echo t("Create, view, and use a set of shortcuts to access administrative pages.", array());
        echo "</p>
<h2>";
        // line 8
        echo t("What are shortcuts?", array());
        echo "</h2>
<p>";
        // line 9
        echo t("<em>Shortcuts</em> are quick links to administrative pages; they are managed by the core Shortcut module. A site can have one or more <em>shortcut sets</em>, which can be shared by one or more users (by default, there is only one set shared by all users); each set contains a limited number of shortcuts. Users need <em>Use shortcuts</em> permission to view shortcuts; <em>Edit current shortcut set</em> permission to add, delete, or edit the shortcuts in the set assigned to them; and <em>Select any shortcut set</em> permission to select a different shortcut set when editing their user profile. There is also an <em>Administer shortcuts</em> permission, which allows an administrator to do any of these actions, as well as select shortcut sets for other users.", array());
        echo "</p>
<h2>";
        // line 10
        echo t("Steps", array());
        echo "</h2>
<ol>
  <li>";
        // line 12
        echo t("Make sure that the core Shortcut module is installed, and that you have a role with <em>Edit current shortcut set</em> or <em>Administer shortcuts</em> permission. Also, make sure that a toolbar module is installed (either the core Toolbar module or a contributed module replacement).", array());
        echo "</li>
  <li>";
        // line 13
        echo t("Navigate to an administrative page that you want in your shortcut list.", array());
        echo "</li>
  <li>";
        // line 14
        echo t("Click the shortcut link to add the page to your shortcut list -- in the core Claro administrative theme, the link looks like a star, and is displayed next to the page title. However, if the page is already in your shortcut set, clicking the shortcut link will remove it from your shortcut set.", array());
        echo "</li>
  <li>";
        // line 15
        echo t("Repeat until all the desired links have been added to your shortcut set.", array());
        echo "</li>
  <li>";
        // line 16
        echo t("Click <em>Shortcuts</em> in the toolbar to display your shortcuts, and verify that the list is complete.", array());
        echo "</li>
  <li>";
        // line 17
        echo t("Optionally, click <em>Edit shortcuts</em> at the right end of the shortcut list (left end in right-to-left languages), to remove links or change their order.", array());
        echo "</li>
  <li>";
        // line 18
        echo t("Click any link in the shortcut bar to go directly to the administrative page.", array());
        echo "</li>
</ol>";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@help_topics/shortcut.overview.html.twig";
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
        return array (  85 => 18,  81 => 17,  77 => 16,  73 => 15,  69 => 14,  65 => 13,  61 => 12,  56 => 10,  52 => 9,  48 => 8,  44 => 7,  39 => 6,);
    }

    public function getSourceContext()
    {
        return new Source("", "@help_topics/shortcut.overview.html.twig", "/opt/drupal/web/core/modules/shortcut/help_topics/shortcut.overview.html.twig");
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
