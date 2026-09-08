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

/* @help_topics/filter.overview.html.twig */
class __TwigTemplate_2e48bb09e3c54ff80b85db352234b5fc extends Template
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
        ob_start(function () { return ''; });
        echo t("Text formats and editors", array());
        $context["overview_link_text"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 11
        $context["overview_link"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getRouteLink($this->sandbox->ensureToStringAllowed(($context["overview_link_text"] ?? null), 11, $this->source), "filter.admin_overview"));
        // line 12
        echo "<h2>";
        echo t("Goal", array());
        echo "</h2>
<p>";
        // line 13
        echo t("Configure text formats on the site.", array());
        echo "</p>
<h2>";
        // line 14
        echo t("What are text filters and text formats?", array());
        echo "</h2>
<p>";
        // line 15
        echo t("A text filter is a processing step that can be applied to text, either to transform it in some way (such as converting URLs in the text into HTML links), or to defend against potentially-dangerous input from site users. A text format is an ordered sequence of text filters. Text filters are provided by modules; text formats are managed by the core Filter module.", array());
        echo "</p>
<p>";
        // line 16
        echo t("Text fields that have \"formatted\" in the field type name, such as <em>Text (formatted)</em>, use text formats. Users choose the text format when editing the field text; when the field text is shown on the site, it is processed by the chosen text format. Administrators can configure text formats and assign permissions for who can use each format. If the core Text Editor module is enabled, administrators can also associate visual editors with text formats.", array());
        echo "</p>
<h2>";
        // line 17
        echo t("What text filters are available?", array());
        echo "</h2>
<p>";
        // line 18
        echo t("Some of the more commonly used text filters are:", array());
        echo "</p>
<dl>
  <dt>";
        // line 20
        echo t("Limit allowed HTML tags and correct faulty HTML", array());
        echo "</dt>
  <dd>";
        // line 21
        echo t("Limits which HTML tags can be used; useful both for site security and enforcing site design.", array());
        echo "</dd>
  <dt>";
        // line 22
        echo t("Convert line breaks into HTML", array());
        echo "</dt>
  <dd>";
        // line 23
        echo t("Line breaks in HTML source are displayed as horizontal spaces. This filter converts line breaks into HTML paragraph and line break tags.", array());
        echo "</dd>
  <dt>";
        // line 24
        echo t("Convert URLs into links", array());
        echo "</dt>
  <dd>";
        // line 25
        echo t("Takes plain URLs in text and turns them into HTML links.", array());
        echo "</dd>
  <dt>";
        // line 26
        echo t("Restrict images to this site", array());
        echo "</dt>
  <dd>";
        // line 27
        echo t("For text formats that allow HTML image tags, restricts images to URLs within this site.", array());
        echo "</dd>
</dl>
<h2>";
        // line 29
        echo t("Steps", array());
        echo "</h2>
<ol>
  <li>";
        // line 31
        echo t("In the <em>Manage</em> administrative menu, navigate to <em>Configuration</em> &gt; <em>Content Authoring</em> &gt; <em>@overview_link</em>. If you do not have the core Text Editor module installed, the menu link and page title will instead be <em>Text formats</em>.", array("@overview_link" => ($context["overview_link"] ?? null), ));
        echo "</li>
  <li>";
        // line 32
        echo t("Click <em>Configure</em> to configure an existing text format, or <em>+ Add text format</em> to create a new text format.", array());
        echo "</li>
  <li>";
        // line 33
        echo t("Enter the desired <em>Name</em> for the text format.", array());
        echo "</li>
  <li>";
        // line 34
        echo t("Check the <em>Roles</em> that can use this text format. Some HTML tags allow users to embed malicious links or scripts in text. To ensure security, anonymous and untrusted users should only have access to text formats that restrict them to either plain text or a safe set of HTML tags. <strong>Improper text format configuration is a security risk.</strong>", array());
        echo "</li>
  <li>";
        // line 35
        echo t("If the core Text Editor module is installed, see the related topic to connect a text editor to this text format.", array());
        echo "</li>
  <li>";
        // line 36
        echo t("Under <em>Enabled filters</em>, check the text filters that you want to use.", array());
        echo "</li>
  <li>";
        // line 37
        echo t("Under <em>Filter processing order</em>, drag the filters to the correct order. Choose the order carefully; for example, if you have a filter that results in a particular HTML tag being added to the text, that should run after a filter that restricts HTML tags, to avoid deleting the new tags the first filter added.", array());
        echo "</li>
  <li>";
        // line 38
        echo t("Under <em>Filter settings</em>, verify and adjust the settings for each active filter that has configuration options.", array());
        echo "</li>
  <li>";
        // line 39
        echo t("Click <em>Save configuration</em>, which will return you to the <em>Text formats and editors</em> page.", array());
        echo "</li>
  <li>";
        // line 40
        echo t("Repeat these steps if you have additional text formats to configure.", array());
        echo "</li>
</ol>";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@help_topics/filter.overview.html.twig";
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
        return array (  149 => 40,  145 => 39,  141 => 38,  137 => 37,  133 => 36,  129 => 35,  125 => 34,  121 => 33,  117 => 32,  113 => 31,  108 => 29,  103 => 27,  99 => 26,  95 => 25,  91 => 24,  87 => 23,  83 => 22,  79 => 21,  75 => 20,  70 => 18,  66 => 17,  62 => 16,  58 => 15,  54 => 14,  50 => 13,  45 => 12,  43 => 11,  39 => 10,);
    }

    public function getSourceContext()
    {
        return new Source("", "@help_topics/filter.overview.html.twig", "/opt/drupal/web/core/modules/filter/help_topics/filter.overview.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 10, "trans" => 10);
        static $filters = array("escape" => 31);
        static $functions = array("render_var" => 11, "help_route_link" => 11);

        try {
            $this->sandbox->checkSecurity(
                ['set', 'trans'],
                ['escape'],
                ['render_var', 'help_route_link']
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
