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

/* @help_topics/core.config_overview.html.twig */
class __TwigTemplate_c394d8c4614001a07f6ff97fc7da2e30 extends Template
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
        // line 10
        echo "<h2>";
        echo t("What is the configuration system?", array());
        echo "</h2>
<p>";
        // line 11
        echo t("The configuration system provides the ability for administrators to customize the site, and to move and synchronize configuration changes between development sites and the live site. It does this in 2 ways:", array());
        echo "</p>
<ol>
  <li>";
        // line 13
        echo t("Providing storage for configuration", array());
        echo "</li>
  <li>";
        // line 14
        echo t("Providing a process in which configuration changes can be imported and exported between instances of the same site; for example, from \"dev\" to \"staging\" to \"live\"", array());
        echo "</li>
</ol>
<h2>";
        // line 16
        echo t("What is configuration data?", array());
        echo "</h2>
<p>";
        // line 17
        echo t("Configuration data describes settings that define how your site behaves or is displayed. For example, when a site administrator updates settings using an administrative form, these settings are stored as configuration data. Configuration data describes settings as simple as a site name and as complex as a view or image style.", array());
        echo "</p>
<h2>";
        // line 18
        echo t("What kinds of configuration are there?", array());
        echo "</h2>
<dl>
  <dt>";
        // line 20
        echo t("Active configuration", array());
        echo "</dt>
  <dd>";
        // line 21
        echo t("Active configuration is the current working configuration of a site. Storage of active configuration is defined by the site, and resides in the database by default.", array());
        echo "</dd>
  <dt>";
        // line 22
        echo t("Simple configuration", array());
        echo "</dt>
  <dd>";
        // line 23
        echo t("A simple configuration item is a group of settings, such as the settings for a module or theme. Each simple configuration item has its own unique structure.", array());
        echo "</dd>
  <dt>";
        // line 24
        echo t("Configuration entities", array());
        echo "</dt>
  <dd>";
        // line 25
        echo t("Configuration entities are user-defined configuration items grouped by type, such as views, image styles, and content types. Each configuration entity within a type has a similar structure.", array());
        echo "</dd>
  <dt>";
        // line 26
        echo t("Default configuration", array());
        echo "</dt>
  <dd>";
        // line 27
        echo t("Default configuration can be defined by a module, theme, or installation profile in its <em>config/install</em> or <em>config/optional</em> directories. Configuration is provided in YAML files (file extension .yml); YAML is a human-readable data serialization standard that is used by the core software for several purposes. Once the default configuration has been imported into the site's active configuration (through installing the extension), that configuration is owned by the site, not the extension. This means that future updates of the extension will not override the site's active configuration for that extension.", array());
        echo "</dd>
</dl>
<h2>";
        // line 29
        echo t("What is configuration synchronization?", array());
        echo "</h2>
<p>";
        // line 30
        echo t("Configuration synchronization is the process of exporting and importing configuration to keep configuration synchronized between different versions of a site; for example, between a development site and the live site.", array());
        echo "</p>
<p>";
        // line 31
        echo t("Each site has unique identifier, also called a <em>UUID</em>, which identifies the site to the system in any instance of the site, as long as the site instances have been reproduced as clones (cloning is when the codebase and database are copied to create a new site instance). When site instances are cloned, a \"dev\" instance of the site has the same UUID as the \"live\" instance. When site instances share the same UUID, configuration can be exported from one instance to another.", array());
        echo "</p>
<p>";
        // line 32
        echo t("The following list contains terms and concepts related to configuration synchronization:", array());
        echo "</p>
<dl>
  <dt>";
        // line 34
        echo t("Exported configuration", array());
        echo "</dt>
  <dd>";
        // line 35
        echo t("When configuration is exported, the active configuration is exported as a set of files in YAML format. When using the <em>Configuration synchronization</em> administrative UI, configuration can be exported as a full-export or single-item archive. This archive can then be imported into the destination site instance.", array());
        echo "</dd>
  <dt>";
        // line 36
        echo t("Imported configuration", array());
        echo "</dt>
  <dd>";
        // line 37
        echo t("Imported configuration is configuration that has been exported from another instance of the site (the \"source\") and is now being imported into another site instance (the \"destination\"), thereby updating its active configuration to match the imported configuration data set.", array());
        echo "</dd>
  <dt>";
        // line 38
        echo t("Configuration sync directory", array());
        echo "</dt>
  <dd>";
        // line 39
        echo t("The configuration sync directory location is set in the site's <em>settings.php</em> file. When configuration is exported, the active configuration is exported and described in YAML files which are stored in the configuration sync directory. After the first export, the system compares the site's active configuration with the configuration data in the sync directory and will only export active configuration items that are different than their counterparts in the sync directory.", array());
        echo "</dd>
</dl>
<h2>";
        // line 41
        echo t("Managing configuration overview", array());
        echo "</h2>
<p>";
        // line 42
        echo t("Configuration management tasks, such as exporting or importing configuration and synchronizing configuration, can be done either through the administrative UI provided by the core Configuration Manager module or a command-line interface (CLI) tool. Defining a configuration sync directory path other than the default value requires read/write access to the site's <em>settings.php</em> file.", array());
        echo "</p>
<p>";
        // line 43
        echo t("Most modules and themes also provide settings forms for updating the configuration they provide. See the related topics listed below for specific tasks.", array());
        echo "</p>
<h2>";
        // line 44
        echo t("Additional resources", array());
        echo "</h2>
<ul>
  <li>";
        // line 46
        echo t("<a href=\"https://www.drupal.org/docs/configuration-management/workflow-using-drush\">Configuration Management: Workflow using Drush</a>", array());
        echo "</li>
  <li>";
        // line 47
        echo t("<a href=\"https://www.drupal.org/docs/user_guide/en/understanding-data.html\">Concept: Types of Data (Drupal User Guide)</a>", array());
        echo "</li>
  <li>";
        // line 48
        echo t("<a href=\"https://www.drupal.org/docs/user_guide/en/install-dev-sites.html\">Concept: Development Sites (Drupal User Guide)</a>", array());
        echo "</li>
  <li>";
        // line 49
        echo t("<a href=\"https://www.drupal.org/docs/user_guide/en/install-dev-making.html\">Making a Development Site (Drupal User Guide)</a>", array());
        echo "</li>
</ul>";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@help_topics/core.config_overview.html.twig";
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
        return array (  175 => 49,  171 => 48,  167 => 47,  163 => 46,  158 => 44,  154 => 43,  150 => 42,  146 => 41,  141 => 39,  137 => 38,  133 => 37,  129 => 36,  125 => 35,  121 => 34,  116 => 32,  112 => 31,  108 => 30,  104 => 29,  99 => 27,  95 => 26,  91 => 25,  87 => 24,  83 => 23,  79 => 22,  75 => 21,  71 => 20,  66 => 18,  62 => 17,  58 => 16,  53 => 14,  49 => 13,  44 => 11,  39 => 10,);
    }

    public function getSourceContext()
    {
        return new Source("", "@help_topics/core.config_overview.html.twig", "/opt/drupal/web/core/modules/help/help_topics/core.config_overview.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("trans" => 10);
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
