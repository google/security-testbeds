<?php

/* core/themes/classy/templates/dataset/table.html.twig */
class __TwigTemplate_98cf6ee9c325be56e5f6e2b50b209532e42534eaeb86ca76b1fbc0eee1a03602 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $tags = array("if" => 43, "for" => 47, "set" => 64);
        $filters = array();
        $functions = array("cycle" => 81);

        try {
            $this->env->getExtension('Twig_Extension_Sandbox')->checkSecurity(
                array('if', 'for', 'set'),
                array(),
                array('cycle')
            );
        } catch (Twig_Sandbox_SecurityError $e) {
            $e->setSourceContext($this->getSourceContext());

            if ($e instanceof Twig_Sandbox_SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof Twig_Sandbox_SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof Twig_Sandbox_SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

        // line 42
        echo "<table";
        echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, ($context["attributes"] ?? null), "html", null, true));
        echo ">
  ";
        // line 43
        if (($context["caption"] ?? null)) {
            // line 44
            echo "    <caption>";
            echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, ($context["caption"] ?? null), "html", null, true));
            echo "</caption>
  ";
        }
        // line 46
        echo "
  ";
        // line 47
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["colgroups"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["colgroup"]) {
            // line 48
            echo "    ";
            if ($this->getAttribute($context["colgroup"], "cols", array())) {
                // line 49
                echo "      <colgroup";
                echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute($context["colgroup"], "attributes", array()), "html", null, true));
                echo ">
        ";
                // line 50
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["colgroup"], "cols", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["col"]) {
                    // line 51
                    echo "          <col";
                    echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute($context["col"], "attributes", array()), "html", null, true));
                    echo " />
        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['col'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 53
                echo "      </colgroup>
    ";
            } else {
                // line 55
                echo "      <colgroup";
                echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute($context["colgroup"], "attributes", array()), "html", null, true));
                echo " />
    ";
            }
            // line 57
            echo "  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['colgroup'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 58
        echo "
  ";
        // line 59
        if (($context["header"] ?? null)) {
            // line 60
            echo "    <thead>
      <tr>
        ";
            // line 62
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["header"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["cell"]) {
                // line 63
                echo "          ";
                // line 64
                $context["cell_classes"] = array(0 => (($this->getAttribute(                // line 65
$context["cell"], "active_table_sort", array())) ? ("is-active") : ("")));
                // line 68
                echo "          <";
                echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute($context["cell"], "tag", array()), "html", null, true));
                echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute($this->getAttribute($context["cell"], "attributes", array()), "addClass", array(0 => ($context["cell_classes"] ?? null)), "method"), "html", null, true));
                echo ">";
                // line 69
                echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute($context["cell"], "content", array()), "html", null, true));
                // line 70
                echo "</";
                echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute($context["cell"], "tag", array()), "html", null, true));
                echo ">
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['cell'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 72
            echo "      </tr>
    </thead>
  ";
        }
        // line 75
        echo "
  ";
        // line 76
        if (($context["rows"] ?? null)) {
            // line 77
            echo "    <tbody>
      ";
            // line 78
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["rows"] ?? null));
            $context['loop'] = array(
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            );
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["row"]) {
                // line 79
                echo "        ";
                // line 80
                $context["row_classes"] = array(0 => (( !                // line 81
($context["no_striping"] ?? null)) ? (twig_cycle(array(0 => "odd", 1 => "even"), $this->getAttribute($context["loop"], "index0", array()))) : ("")));
                // line 84
                echo "        <tr";
                echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute($this->getAttribute($context["row"], "attributes", array()), "addClass", array(0 => ($context["row_classes"] ?? null)), "method"), "html", null, true));
                echo ">
          ";
                // line 85
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["row"], "cells", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["cell"]) {
                    // line 86
                    echo "            <";
                    echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute($context["cell"], "tag", array()), "html", null, true));
                    echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute($context["cell"], "attributes", array()), "html", null, true));
                    echo ">";
                    // line 87
                    echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute($context["cell"], "content", array()), "html", null, true));
                    // line 88
                    echo "</";
                    echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute($context["cell"], "tag", array()), "html", null, true));
                    echo ">
          ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['cell'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 90
                echo "        </tr>
      ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['row'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 92
            echo "    </tbody>
  ";
        } elseif (        // line 93
($context["empty"] ?? null)) {
            // line 94
            echo "    <tbody>
      <tr class=\"odd\">
        <td colspan=\"";
            // line 96
            echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, ($context["header_columns"] ?? null), "html", null, true));
            echo "\" class=\"empty message\">";
            echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, ($context["empty"] ?? null), "html", null, true));
            echo "</td>
      </tr>
    </tbody>
  ";
        }
        // line 100
        echo "  ";
        if (($context["footer"] ?? null)) {
            // line 101
            echo "    <tfoot>
      ";
            // line 102
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["footer"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["row"]) {
                // line 103
                echo "        <tr";
                echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute($context["row"], "attributes", array()), "html", null, true));
                echo ">
          ";
                // line 104
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["row"], "cells", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["cell"]) {
                    // line 105
                    echo "            <";
                    echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute($context["cell"], "tag", array()), "html", null, true));
                    echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute($context["cell"], "attributes", array()), "html", null, true));
                    echo ">";
                    // line 106
                    echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute($context["cell"], "content", array()), "html", null, true));
                    // line 107
                    echo "</";
                    echo $this->env->getExtension('Twig_Extension_Sandbox')->ensureToStringAllowed($this->env->getExtension('Drupal\Core\Template\TwigExtension')->escapeFilter($this->env, $this->getAttribute($context["cell"], "tag", array()), "html", null, true));
                    echo ">
          ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['cell'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 109
                echo "        </tr>
      ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['row'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 111
            echo "    </tfoot>
  ";
        }
        // line 113
        echo "</table>
";
    }

    public function getTemplateName()
    {
        return "core/themes/classy/templates/dataset/table.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  273 => 113,  269 => 111,  262 => 109,  253 => 107,  251 => 106,  246 => 105,  242 => 104,  237 => 103,  233 => 102,  230 => 101,  227 => 100,  218 => 96,  214 => 94,  212 => 93,  209 => 92,  194 => 90,  185 => 88,  183 => 87,  178 => 86,  174 => 85,  169 => 84,  167 => 81,  166 => 80,  164 => 79,  147 => 78,  144 => 77,  142 => 76,  139 => 75,  134 => 72,  125 => 70,  123 => 69,  118 => 68,  116 => 65,  115 => 64,  113 => 63,  109 => 62,  105 => 60,  103 => 59,  100 => 58,  94 => 57,  88 => 55,  84 => 53,  75 => 51,  71 => 50,  66 => 49,  63 => 48,  59 => 47,  56 => 46,  50 => 44,  48 => 43,  43 => 42,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "core/themes/classy/templates/dataset/table.html.twig", "/var/www/html/core/themes/classy/templates/dataset/table.html.twig");
    }
}
