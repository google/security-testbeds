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

/* @help_topics/core.web_services.html.twig */
class __TwigTemplate_0aa7bcaf0307bf11b7ba8f3249b2d6b0 extends Template
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
        $context["content_structure_topic"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getTopicLink("core.content_structure"));
        // line 8
        echo "<h2>";
        echo t("What is a web service?", array());
        echo "</h2>
<p>";
        // line 9
        echo t("A web service allows your site to provide its content and data to other web sites and applications. Typically, the data is transported via <a href=\"https://en.wikipedia.org/wiki/Hypertext_Transfer_Protocol\">HTTP</a> in a serialized machine-readable format.", array());
        echo "</p>
<h2>";
        // line 10
        echo t("What is serialization?", array());
        echo "</h2>
<p>";
        // line 11
        echo t("Serialization is the process of converting complex data structures into text strings, so that they can be exchanged and stored. The reverse process is called <em>deserialization</em>. JSON and XML are the two most-commonly-used data serialization formats for web services.", array());
        echo "</p>
<h2>";
        // line 12
        echo t("What is HTTP Basic authentication?", array());
        echo "</h2>
<p>";
        // line 13
        echo t("<a href=\"http://en.wikipedia.org/wiki/Basic_access_authentication\">HTTP Basic authentication</a> is a method for authenticating requests by sending a user name and password along with the request.", array());
        echo "</p>
<h2>";
        // line 14
        echo t("What modules provide web services?", array());
        echo "</h2>
<p>";
        // line 15
        echo t("The following core software modules provide web services:", array());
        echo "</p>
<dl>
  <dt>";
        // line 17
        echo t("JSON:API module", array());
        echo "</dt>
  <dd>";
        // line 18
        echo t("Exposes <em>entities</em> to other applications using a fully compliant implementation of the <a href=\"https://jsonapi.org\">JSON:API Specification</a>. See @content_structure_topic for more information on content entities and fields.", array("@content_structure_topic" => ($context["content_structure_topic"] ?? null), ));
        echo "</dd>
  <dt>";
        // line 19
        echo t("RESTful Web Services module", array());
        echo "</dt>
  <dd>";
        // line 20
        echo t("Exposes entities and other resources to other applications using a <a href=\"https://en.wikipedia.org/wiki/Representational_state_transfer\">REST</a> implementation. Data is exchanged using a serialization format such as JSON, and transferred using an authentication method such as HTTP Basic Authentication.", array());
        echo "</dd>
  <dt>";
        // line 21
        echo t("Serialization module", array());
        echo "</dt>
  <dd>";
        // line 22
        echo t("Provides a framework for adding specific serialization formats for other modules to use.", array());
        echo "</dd>
  <dt>";
        // line 23
        echo t("HTTP Basic Authentication module", array());
        echo "</dt>
  <dd>";
        // line 24
        echo t("Provides a way for web services to be authenticated using HTTP Basic authentication against site user accounts.", array());
        echo "</dd>
</dl>
<p>";
        // line 26
        echo t("There are also contributed modules that provide web services.", array());
        echo "</p>
<h2>";
        // line 27
        echo t("Additional resources", array());
        echo "</h2>
<ul>
  <li><a href=\"https://www.drupal.org/docs/8/core/modules/rest\">";
        // line 29
        echo t("Online documentation for the RESTful Web Services module", array());
        echo "</a></li>
  <li><a href=\"https://www.drupal.org/docs/core-modules-and-themes/core-modules/jsonapi-module\">";
        // line 30
        echo t("Online documentation for the JSON:API module", array());
        echo "</a></li>
  <li><a href=\"https://www.drupal.org/docs/core-modules-and-themes/core-modules/jsonapi-module/jsonapi-vs-cores-rest-module\">";
        // line 31
        echo t("Comparison of the RESTFul Web Services and JSON:API modules", array());
        echo "</a></li>
</ul>";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@help_topics/core.web_services.html.twig";
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
        return array (  125 => 31,  121 => 30,  117 => 29,  112 => 27,  108 => 26,  103 => 24,  99 => 23,  95 => 22,  91 => 21,  87 => 20,  83 => 19,  79 => 18,  75 => 17,  70 => 15,  66 => 14,  62 => 13,  58 => 12,  54 => 11,  50 => 10,  46 => 9,  41 => 8,  39 => 7,);
    }

    public function getSourceContext()
    {
        return new Source("", "@help_topics/core.web_services.html.twig", "/opt/drupal/web/core/modules/help/help_topics/core.web_services.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 7, "trans" => 8);
        static $filters = array("escape" => 18);
        static $functions = array("render_var" => 7, "help_topic_link" => 7);

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
