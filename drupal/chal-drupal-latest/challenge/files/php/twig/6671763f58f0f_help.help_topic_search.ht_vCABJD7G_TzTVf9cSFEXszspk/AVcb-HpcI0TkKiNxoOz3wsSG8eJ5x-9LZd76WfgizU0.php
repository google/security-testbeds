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

/* @help_topics/help.help_topic_search.html.twig */
class __TwigTemplate_8b1c96788c539957c4fd350a6b26dfde extends Template
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
        echo t("Extend", array());
        $context["extend_link_text"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 10
        ob_start(function () { return ''; });
        echo t("Help", array());
        $context["help_link_text"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 11
        $context["extend_link"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getRouteLink($this->sandbox->ensureToStringAllowed(($context["extend_link_text"] ?? null), 11, $this->source), "system.modules_list"));
        // line 12
        $context["help_link"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getRouteLink($this->sandbox->ensureToStringAllowed(($context["help_link_text"] ?? null), 12, $this->source), "help.main"));
        // line 13
        $context["cache_topic"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getTopicLink("system.cache"));
        // line 14
        $context["cron_topic"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getTopicLink("core.cron"));
        // line 15
        echo "<h2>";
        echo t("Goal", array());
        echo "</h2>
<p>";
        // line 16
        echo t("Set up your site so that users can search for help.", array());
        echo "</p>
<h2>";
        // line 17
        echo t("Steps", array());
        echo "</h2>
<ol>
  <li>";
        // line 19
        echo t("In the <em>Manage</em> administrative menu, navigate to <em>@extend_link</em>. Verify that the Search, Help, and Block modules are installed (or install them if they are not already installed).", array("@extend_link" => ($context["extend_link"] ?? null), ));
        echo "</li>
  <li>";
        // line 20
        echo t("In the <em>Manage</em> administrative menu, navigate to <em>Configuration</em> &gt; <em>Search and metadata</em> &gt; <em>Search pages</em>.", array());
        echo "</li>
  <li>";
        // line 21
        echo t("Verify that a Help search page is listed in the <em>Search pages</em> section. If not, add a new page of type <em>Help</em>.", array());
        echo "</li>
  <li>";
        // line 22
        echo t("Check the indexing status of the Help search page. If it is not fully indexed, see @cron_topic about how to run Cron until indexing is complete.", array("@cron_topic" => ($context["cron_topic"] ?? null), ));
        echo "</li>
  <li>";
        // line 23
        echo t("In the future, you can click <em>Rebuild search index</em> on this page, or @cache_topic, in order to force help topic text to be reindexed for searching. This should be done whenever a module, theme, language, or string translation is updated.", array("@cache_topic" => ($context["cache_topic"] ?? null), ));
        echo "</li>
  <li>";
        // line 24
        echo t("In the <em>Manage</em> administrative menu, navigate to <em>Structure</em> &gt; <em>Block layout</em>.", array());
        echo "</li>
  <li>";
        // line 25
        echo t("Click the link for your administrative theme (such as the core Claro theme), near the top of the page, and verify that there is already a search block for help located in the Help region. If not, follow the steps in the related topic to place the <em>Search form</em> block in the Help region. When configuring the block, choose <em>Help</em> as the search page, and in the <em>Pages</em> tab under <em>Visibility</em>, enter <em>/admin/help</em> to make the search form only visible on the main <em>Help</em> page.", array());
        echo "</li>
  <li>";
        // line 26
        echo t("In the <em>Manage</em> administrative menu, navigate to <em>@help_link</em>. Verify that the search block is visible, and try a search.", array("@help_link" => ($context["help_link"] ?? null), ));
        echo "</li>
</ol>";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@help_topics/help.help_topic_search.html.twig";
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
        return array (  97 => 26,  93 => 25,  89 => 24,  85 => 23,  81 => 22,  77 => 21,  73 => 20,  69 => 19,  64 => 17,  60 => 16,  55 => 15,  53 => 14,  51 => 13,  49 => 12,  47 => 11,  43 => 10,  39 => 9,);
    }

    public function getSourceContext()
    {
        return new Source("", "@help_topics/help.help_topic_search.html.twig", "/opt/drupal/web/core/modules/help/help_topics/help.help_topic_search.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 9, "trans" => 9);
        static $filters = array("escape" => 19);
        static $functions = array("render_var" => 11, "help_route_link" => 11, "help_topic_link" => 13);

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
