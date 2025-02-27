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

/* @help_topics/path.creating_alias.html.twig */
class __TwigTemplate_cef02f2322824cfdc79ddb76e4549655 extends Template
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
        // line 9
        ob_start(function () { return ''; });
        // line 10
        echo t("Create and edit URL aliases", array());
        $context["path_permissions_link_text"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 12
        $context["path_permissions_link"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getRouteLink($this->sandbox->ensureToStringAllowed(($context["path_permissions_link_text"] ?? null), 12, $this->source), "user.admin_permissions.module", ["modules" => "path"]));
        // line 13
        $context["overview_topic"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getTopicLink("path.overview"));
        // line 14
        echo "<h2>";
        echo t("Goal", array());
        echo "</h2>
<p>";
        // line 15
        echo t("Give a content item page a human- or SEO-friendly URL alias; you can follow similar steps to create an alias for a taxonomy term page. See @overview_topic for more about aliases.", array("@overview_topic" => ($context["overview_topic"] ?? null), ));
        echo "</p>
<h2>";
        // line 16
        echo t("Who can create URL aliases?", array());
        echo "</h2>
<p>";
        // line 17
        echo t("Users with the <em>@path_permissions_link</em> permission can create aliases. To follow the steps in this topic, you will also need permission to edit the content item.", array("@path_permissions_link" => ($context["path_permissions_link"] ?? null), ));
        echo "</p>
<h2>";
        // line 18
        echo t("Steps", array());
        echo "</h2>
<ol>
  <li>";
        // line 20
        echo t("Locate and open the content edit form for the content item, or create a new content item (see related topics on creating and editing content).", array());
        echo "</li>
  <li>";
        // line 21
        echo t("Under <em>URL alias</em> on the edit form, enter the desired alias (for example, \"/about-us\"). Make sure the alias starts with a \"/\" character.", array());
        echo "</li>
  <li>";
        // line 22
        echo t("Click <em>Save</em>.", array());
        echo "</li>
  <li>";
        // line 23
        echo t("Verify that the page can be visited with the new alias, for example <em>https://example.com/about-us</em>.", array());
        echo "</li>
</ol>
<h2>";
        // line 25
        echo t("Additional resources", array());
        echo "</h2>
<ul>
  <li><a href=\"https://www.drupal.org/docs/user_guide/en/content-create.html\">";
        // line 27
        echo t("Creating a Content Item (Drupal User Guide)", array());
        echo "</a></li>
</ul>";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@help_topics/path.creating_alias.html.twig";
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
        return array (  92 => 27,  87 => 25,  82 => 23,  78 => 22,  74 => 21,  70 => 20,  65 => 18,  61 => 17,  57 => 16,  53 => 15,  48 => 14,  46 => 13,  44 => 12,  41 => 10,  39 => 9,);
    }

    public function getSourceContext()
    {
        return new Source("", "@help_topics/path.creating_alias.html.twig", "/opt/drupal/web/core/modules/path/help_topics/path.creating_alias.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 9, "trans" => 10);
        static $filters = array("escape" => 15);
        static $functions = array("render_var" => 12, "help_route_link" => 12, "help_topic_link" => 13);

        try {
            $this->sandbox->checkSecurity(
                ['set', 'trans'],
                ['escape'],
                ['render_var', 'help_route_link', 'help_topic_link']
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
