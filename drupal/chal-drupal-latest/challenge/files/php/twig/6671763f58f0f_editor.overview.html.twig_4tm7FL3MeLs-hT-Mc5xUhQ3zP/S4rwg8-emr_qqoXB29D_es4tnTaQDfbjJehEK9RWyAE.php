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

/* @help_topics/editor.overview.html.twig */
class __TwigTemplate_b1a20178d562ec33e128f1fa67c88d98 extends Template
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
        $context["filter_overview_topic"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getTopicLink("filter.overview"));
        // line 9
        ob_start(function () { return ''; });
        echo t("Text formats and editors", array());
        $context["overview_link_text"] = ('' === $tmp = ob_get_clean()) ? '' : new Markup($tmp, $this->env->getCharset());
        // line 10
        $context["overview_link"] = $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar($this->extensions['Drupal\help\HelpTwigExtension']->getRouteLink($this->sandbox->ensureToStringAllowed(($context["overview_link_text"] ?? null), 10, $this->source), "filter.admin_overview"));
        // line 11
        echo "<h2>";
        echo t("Goal", array());
        echo "</h2>
<p>";
        // line 12
        echo t("Configure a text format so that when a user is editing text and selects this text format, a text editor installed on your site is shown. Configure the text editor, such as choosing which buttons and functions are available. See @filter_overview_topic for more about text formats.", array("@filter_overview_topic" => ($context["filter_overview_topic"] ?? null), ));
        echo "</p>
<h2>";
        // line 13
        echo t("What is a text editor?", array());
        echo "</h2>
<p>";
        // line 14
        echo t("A text editor is software (typically, a JavaScript library) that provides buttons and other command mechanisms to make editing HTML text easier. Some editors are called <em>visual</em> or <em>WYSIWYG (What You See Is What You Get)</em> editors; these editors hide the details of HTML from the user, and instead show formatted output on the screen. The core Text Editor module provides a framework for deploying text editors on your site. The core CKEditor 5 module provides CKEditor 5, which is a widely-used JavaScript text editor that creates clean and valid HTML; the module also enforces the HTML tag restrictions in the associated text format. Various contributed modules provide other editors; to install a new editor, besides installing the module, you may need to download the editor library from a third-party site.", array());
        echo "</p>
<h2>";
        // line 15
        echo t("Steps", array());
        echo "</h2>
<ol>
  <li>";
        // line 17
        echo t("In the <em>Manage</em> administrative menu, navigate to <em>Configuration</em> &gt; <em>Content Authoring</em> &gt; <em>@overview_link</em>. The <em>Text editor</em> column in the table shows the text editor that is currently connected to each text format, if any.", array("@overview_link" => ($context["overview_link"] ?? null), ));
        echo "</li>
  <li>";
        // line 18
        echo t("Follow the steps on @filter_overview_topic to add a new text format or configure an existing text format; when you reach the step about text editors, return to this topic.", array("@filter_overview_topic" => ($context["filter_overview_topic"] ?? null), ));
        echo "</li>
  <li>";
        // line 19
        echo t("Select <em>CKEditor 5</em> as the <em>Text editor</em>, or another text editor that you have installed. The rest of these steps assume you selected <em>CKEditor 5</em>.", array());
        echo "</li>
  <li>";
        // line 20
        echo t("Under <em>Toolbar configuration</em>, drag buttons between <em>Available buttons</em> and <em>Active toolbar</em>; only buttons in <em>Active toolbar</em> will be shown to the user. Focusing or hovering over a button will display a tooltip explaining what the button does.", array());
        echo "</li>
  <li>";
        // line 21
        echo t("Drag buttons within <em>Active toolbar</em> to the desired order, and group buttons by dragging them between group identifiers; drag <em>a new group identifier</em> to the toolbar to add additional groups.", array());
        echo "</li>
  <li>";
        // line 22
        echo t("If you add buttons that require configuration, the <em>CKEditor 5 plugin settings</em> section will be visible, and provide their respective configuration forms.", array());
        echo "</li>
  <li>";
        // line 23
        echo t("Return to @filter_overview_topic to complete the text format configuration, and be sure to save the text format.", array("@filter_overview_topic" => ($context["filter_overview_topic"] ?? null), ));
        echo "</li>
</ol>";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@help_topics/editor.overview.html.twig";
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
        return array (  93 => 23,  89 => 22,  85 => 21,  81 => 20,  77 => 19,  73 => 18,  69 => 17,  64 => 15,  60 => 14,  56 => 13,  52 => 12,  47 => 11,  45 => 10,  41 => 9,  39 => 8,);
    }

    public function getSourceContext()
    {
        return new Source("", "@help_topics/editor.overview.html.twig", "/opt/drupal/web/core/modules/editor/help_topics/editor.overview.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("set" => 8, "trans" => 9);
        static $filters = array("escape" => 12);
        static $functions = array("render_var" => 8, "help_topic_link" => 8, "help_route_link" => 10);

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
