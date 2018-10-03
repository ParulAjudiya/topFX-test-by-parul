<?php

/* C:\xampp\htdocs\topFXtestv1\vendor\cakephp\bake\src\Template\Bake\Shell\shell.twig */
class __TwigTemplate_98870bef7d1d0d0dc293c4e21372e94e10757781c96b5a65b55f43ff25dabdf5 extends Twig_Template
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
        $__internal_770edd655cdeb606afc443e4edb1f19b4248a91788cb82e88bf8b9495a7c5cfa = $this->env->getExtension("WyriHaximus\\TwigView\\Lib\\Twig\\Extension\\Profiler");
        $__internal_770edd655cdeb606afc443e4edb1f19b4248a91788cb82e88bf8b9495a7c5cfa->enter($__internal_770edd655cdeb606afc443e4edb1f19b4248a91788cb82e88bf8b9495a7c5cfa_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "C:\\xampp\\htdocs\\topFXtestv1\\vendor\\cakephp\\bake\\src\\Template\\Bake\\Shell\\shell.twig"));

        // line 16
        echo "<?php
namespace ";
        // line 17
        echo twig_escape_filter($this->env, ($context["namespace"] ?? null), "html", null, true);
        echo "\\Shell;

use Cake\\Console\\Shell;

/**
 * ";
        // line 22
        echo twig_escape_filter($this->env, ($context["name"] ?? null), "html", null, true);
        echo " shell command.
 */
class ";
        // line 24
        echo twig_escape_filter($this->env, ($context["name"] ?? null), "html", null, true);
        echo "Shell extends Shell
{

    /**
     * Manage the available sub-commands along with their arguments and help
     *
     * @see http://book.cakephp.org/3.0/en/console-and-shells.html#configuring-options-and-generating-help
     *
     * @return \\Cake\\Console\\ConsoleOptionParser
     */
    public function getOptionParser()
    {
        \$parser = parent::getOptionParser();

        return \$parser;
    }

    /**
     * main() method.
     *
     * @return bool|int|null Success or error code.
     */
    public function main()
    {
        \$this->out(\$this->OptionParser->help());
    }
}
";
        
        $__internal_770edd655cdeb606afc443e4edb1f19b4248a91788cb82e88bf8b9495a7c5cfa->leave($__internal_770edd655cdeb606afc443e4edb1f19b4248a91788cb82e88bf8b9495a7c5cfa_prof);

    }

    public function getTemplateName()
    {
        return "C:\\xampp\\htdocs\\topFXtestv1\\vendor\\cakephp\\bake\\src\\Template\\Bake\\Shell\\shell.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  38 => 24,  33 => 22,  25 => 17,  22 => 16,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{#
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         2.0.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
#}
<?php
namespace {{ namespace }}\\Shell;

use Cake\\Console\\Shell;

/**
 * {{ name }} shell command.
 */
class {{ name }}Shell extends Shell
{

    /**
     * Manage the available sub-commands along with their arguments and help
     *
     * @see http://book.cakephp.org/3.0/en/console-and-shells.html#configuring-options-and-generating-help
     *
     * @return \\Cake\\Console\\ConsoleOptionParser
     */
    public function getOptionParser()
    {
        \$parser = parent::getOptionParser();

        return \$parser;
    }

    /**
     * main() method.
     *
     * @return bool|int|null Success or error code.
     */
    public function main()
    {
        \$this->out(\$this->OptionParser->help());
    }
}
", "C:\\xampp\\htdocs\\topFXtestv1\\vendor\\cakephp\\bake\\src\\Template\\Bake\\Shell\\shell.twig", "C:\\xampp\\htdocs\\topFXtestv1\\vendor\\cakephp\\bake\\src\\Template\\Bake\\Shell\\shell.twig");
    }
}
