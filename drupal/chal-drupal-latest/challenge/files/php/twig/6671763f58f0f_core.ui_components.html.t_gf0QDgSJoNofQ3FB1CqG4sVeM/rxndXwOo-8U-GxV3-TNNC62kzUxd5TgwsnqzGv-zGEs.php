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

/* @help_topics/core.ui_components.html.twig */
class __TwigTemplate_db33f79556364ed458188b229a2197ce extends Template
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
        $context["accessibility_topic"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getTopicLink("core.ui_accessibility"));
        // line 8
        $context["settings_tray_topic"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getTopicLink("core.settings_tray"));
        // line 9
        $context["admin_link"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getRouteLink("/admin", "system.admin"));
        // line 10
        echo "<h2>";
        echo t("What administrative interface components are available?", array());
        echo "</h2>
<p>";
        // line 11
        echo t("The following administrative interface components are provided by the core software and its modules (some contributed modules offer additional functionality):", array());
        echo "</p>
<ul>
  <li>";
        // line 13
        echo t("Accessibility features, to enable all users to perform administrative tasks. See @accessibility_topic for more information.", array("@accessibility_topic" => ($context["accessibility_topic"] ?? null), ));
        echo "</li>
  <li>";
        // line 14
        echo t("A menu system, which you can navigate to find pages for administrative tasks. The core Toolbar module displays this menu on the top or left side of the page (right side in right-to-left languages). There are also contributed module replacements for the core Toolbar module, with additional features, such as the <a href=\"https://www.drupal.org/project/admin_toolbar\">Admin Toolbar module</a>.", array());
        echo "</li>
  <li>";
        // line 15
        echo t("The core Shortcuts module enhances the toolbar with a configurable list of links to commonly-used tasks.", array());
        echo "</li>
  <li>";
        // line 16
        echo t("If you install the core Contextual Links module, non-administrative pages will contain links leading to related administrative tasks.", array());
        echo "</li>
  <li>";
        // line 17
        echo t("In-place or <em>quick</em> editing. In-place editing of configuration is provided by the core Settings Tray module. See @settings_tray_topic for more information.", array("@settings_tray_topic" => ($context["settings_tray_topic"] ?? null), ));
        echo "</li>
  <li>";
        // line 18
        echo t("The core Help module displays help topics, and provides a Help block that can be placed on administrative pages to provide an overview of their functionality.", array());
        echo "</li>
</ul>
<h2>";
        // line 20
        echo t("What are the sections of the administrative menu?", array());
        echo "</h2>
<p>";
        // line 21
        echo t("The administrative menu, which you can navigate by visiting <em>@admin_link</em> on your site or by using an administrative toolbar, has the following sections (some may not be available, depending on which modules are currently installed on your site, and your permissions):", array("@admin_link" => ($context["admin_link"] ?? null), ));
        echo "</p>
<ul>
  <li>";
        // line 23
        echo t("<strong>Content:</strong> Find, manage, and create new pages; manage comments and files.", array());
        echo "</li>
  <li>";
        // line 24
        echo t("<strong>Structure:</strong> Place and edit blocks, set up content types and fields, configure menus, administer taxonomy, and configure some contributed modules.", array());
        echo "</li>
  <li>";
        // line 25
        echo t("<strong>Appearance:</strong> Switch between themes, install themes, and update existing themes.", array());
        echo "</li>
  <li>";
        // line 26
        echo t("<strong>Extend:</strong> Update, install, and uninstall modules.", array());
        echo "</li>
  <li>";
        // line 27
        echo t("<strong>Configuration:</strong> Configure the settings for various site functionality, including some contributed modules.", array());
        echo "</li>
  <li>";
        // line 28
        echo t("<strong>People:</strong> Manage user accounts and permissions.", array());
        echo "</li>
  <li>";
        // line 29
        echo t("<strong>Reports:</strong> Display information about site security, necessary updates, and site activity.", array());
        echo "</li>
  <li>";
        // line 30
        echo t("<strong>Help:</strong> Get help on using the administrative interface.", array());
        echo "</li>
</ul>
<h2>";
        // line 32
        echo t("Administrative interface overview", array());
        echo "</h2>
<p>";
        // line 33
        echo t("Install the core modules mentioned above to use the corresponding aspect of the administrative interface. See the related topics listed below for more details on some aspects of the administrative interface.", array());
        echo "</p>";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@help_topics/core.ui_components.html.twig";
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
        return array (  126 => 33,  122 => 32,  117 => 30,  113 => 29,  109 => 28,  105 => 27,  101 => 26,  97 => 25,  93 => 24,  89 => 23,  84 => 21,  80 => 20,  75 => 18,  71 => 17,  67 => 16,  63 => 15,  59 => 14,  55 => 13,  50 => 11,  45 => 10,  43 => 9,  41 => 8,  39 => 7,);
    }

    public function getSourceContext()
    {
        return new Source("", "@help_topics/core.ui_components.html.twig", "/opt/drupal/web/core/modules/help/help_topics/core.ui_components.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 7, "trans" => 10);
        static $filters = array("escape" => 13);
        static $functions = array("render_var" => 7, "help_topic_link" => 7, "help_route_link" => 9);

        try {
            $this->sandbox->checkSecurity(
                ['set', 'trans'],
                ['escape'],
                ['render_var', 'help_topic_link', 'help_route_link']
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
