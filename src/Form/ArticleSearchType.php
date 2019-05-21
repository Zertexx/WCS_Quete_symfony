<?php
/**
 * Created by PhpStorm.
 * User: zerto
 * Date: 21/05/2019
 * Time: 21:15
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class ArticleSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('searchField');
    }
}

