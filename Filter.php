<?php
/**
 * @package   ImpressPages
 */

namespace Plugin\AlternateHreflang;
/**
 * Created by PhpStorm.
 * User: mangirdas
 * Date: 14.10.26
 * Time: 21.57
 */

class Filter
{

    public static function ipHead($head, $info)
    {
        $page = ipContent()->getCurrentPage();
        if (!$page) {
            return $head; //do nothing
        }

        $key = Model::getPageKey($page->getId());

        if (empty($key)) {
            return $head; //do nothing
        }

        $pageIds = Model::getPageIdsByKey($key);

        $additionalHead = '';

        foreach($pageIds as $alternatePageId) {
            if ($alternatePageId == $page->getId()) {
                continue;
            }
            $alternatePage = ipContent()->getPage($alternatePageId);
            if (!$alternatePage) {
                continue;
            }
            $additionalHead .= "\n" . '<meta rel="alternate" hreflang="' . escAttr($alternatePage->getLanguageCode()) . '" href="' . escAttr($alternatePage->getLink()) . '" />';
        }

        return $head . $additionalHead;

    }

    /**
     * @param \Ip\Form $form
     * @return mixed
     */
    public static function ipPagePropertiesForm($form, $info)
    {
        $current = Model::getPageKey($info['pageId']);

        $fieldset = new \Ip\Form\Fieldset(__('Alternate pages', 'AlternateHreflang', false));
        $form->addFieldset($fieldset);

        $form->addField(new \Ip\Form\Field\Text(
                array(
                    'name' => 'alternatehreflang',
                    'label' => __('Key', 'AlternateHreflang', false),
                    'value' => $current,
                    'note' => __('Enter the same key for all pages that has to be linked using alternate tag', 'AlternateHreflang', false)
                )
            )
        );

        return $form;
    }
}
