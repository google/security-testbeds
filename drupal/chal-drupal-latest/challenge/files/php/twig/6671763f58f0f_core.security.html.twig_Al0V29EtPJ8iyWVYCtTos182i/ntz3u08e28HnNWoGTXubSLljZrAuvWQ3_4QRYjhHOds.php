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

/* @help_topics/core.security.html.twig */
class __TwigTemplate_ce1ca85d9b8d4e928eeefe6198973623 extends Template
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
        // line 5
        echo "<h2>";
        echo t("What are security updates?", array());
        echo "</h2>
<p>";
        // line 6
        echo t("Any software occasionally has bugs, and sometimes these bugs have security implications. When security bugs are fixed in the core software, modules, or themes that your site uses, they are released in a <em>security update</em>. You will need to apply security updates in order to keep your site secure.", array());
        echo "</p>
<h2>";
        // line 7
        echo t("What are security advisories?", array());
        echo "</h2>
<p>";
        // line 8
        echo t("A security advisory is a public announcement about a reported security problem in the core software. Contributed projects with a shield icon and \"Stable releases for this project are covered by the security advisory policy\" on their project page are also covered by Drupal's security advisory policy. Security advisories are managed by the <a href=\"https://www.drupal.org/drupal-security-team\">Drupal Security Team</a>.", array());
        echo "</p>
<h2>";
        // line 9
        echo t("Security tasks", array());
        echo "</h2>
<p>";
        // line 10
        echo t("Keeping track of updates, updating the core software, and updating contributed modules and/or themes are all part of keeping your site secure. See the related topics listed below for specific tasks.", array());
        echo "</p>
<h2>";
        // line 11
        echo t("Additional resources", array());
        echo "</h2>
<ul>
    <li>";
        // line 13
        echo t("<a href=\"https://www.drupal.org/docs/user_guide/en/security-chapter.html\">Security and Maintenance (Drupal User Guide)</a>", array());
        echo "</li>
  <li>";
        // line 14
        echo t("<a href=\"https://www.drupal.org/drupal-security-team/security-advisory-process-and-permissions-policy\">Security advisory process and permissions policy</a>", array());
        echo "</li>
</ul>";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName()
    {
        return "@help_topics/core.security.html.twig";
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
        return array (  73 => 14,  69 => 13,  64 => 11,  60 => 10,  56 => 9,  52 => 8,  48 => 7,  44 => 6,  39 => 5,);
    }

    public function getSourceContext()
    {
        return new Source("", "@help_topics/core.security.html.twig", "/opt/drupal/web/core/modules/help/help_topics/core.security.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("trans" => 5);
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
