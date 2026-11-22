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

/* @help_topics/core.translations.html.twig */
class __TwigTemplate_481290071f13c3858bcde49eddb4ef5d extends Template
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
        // line 8
        $context["config_overview_topic"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getTopicLink("core.config_overview"));
        // line 9
        $context["content_structure_topic"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getTopicLink("core.content_structure"));
        // line 10
        echo "<h2>";
        echo t("What text can be translated in your site?", array());
        echo "</h2>
<p>";
        // line 11
        echo t("There are three types of text that can be translated:", array());
        echo "</p>
<ul>
  <li>";
        // line 13
        echo t("Content (blocks, content items, etc.) can be written in English or another language, and can be translated into additional languages. See @content_structure_topic to learn more about content.", array("@content_structure_topic" => ($context["content_structure_topic"] ?? null), ));
        echo "</li>
  <li>";
        // line 14
        echo t("Many configuration items also include text that can be translated. Default configuration provided by your site's software is provided in English; you can also download community-provided translations. See @config_overview_topic to learn more about configuration.", array("@config_overview_topic" => ($context["config_overview_topic"] ?? null), ));
        echo "</li>
  <li>";
        // line 15
        echo t("User interface text that is provided by the core software, your install profile, themes, and modules is provided in English, but can be translated into other languages. You can also download translations that community-members have provided.", array());
        echo "</li>
</ul>
<h2>";
        // line 17
        echo t("Working with languages overview", array());
        echo "</h2>
<p>";
        // line 18
        echo t("The core Language module lets you add new languages to your site, provides the <em>Language switcher</em> block, and provides the ability to configure block visibility by language; the block and block visibility settings are only available if you have multiple languages configured. The core Content Translation, Configuration Translation, and Interface Translation modules let you translate content, configuration, and the built-in user interface, respectively. The core Update Manager module manages automatic downloads of community-provided translations of default configuration and user-interface text. See the related topics listed below for specific tasks.", array());
        echo "</p>";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@help_topics/core.translations.html.twig";
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
        return array (  70 => 18,  66 => 17,  61 => 15,  57 => 14,  53 => 13,  48 => 11,  43 => 10,  41 => 9,  39 => 8,);
    }

    public function getSourceContext()
    {
        return new Source("", "@help_topics/core.translations.html.twig", "/opt/drupal/web/core/modules/help/help_topics/core.translations.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 8, "trans" => 10);
        static $filters = array("escape" => 13);
        static $functions = array("render_var" => 8, "help_topic_link" => 8);

        try {
            $this->sandbox->checkSecurity(
                ['set', 'trans'],
                ['escape'],
                ['render_var', 'help_topic_link']
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
