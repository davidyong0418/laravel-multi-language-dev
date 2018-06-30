<?php
namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Request;
use Nutnet\Artifico2\Navigation\App\Models\Item;
use App\Helpers\MenuHelper;


class Navigation
{
    private $itemModel;

    /**
     * Navigation constructor.
     * @param Item $itemModel
     */
    public function __construct(Item $itemModel)
    {
        $this->itemModel = $itemModel;
    }

    /**
     * @param Item $nav
     * @param array $options
     * @return string
     */
    public function link(Item $nav, array $options = [])
    {
        $link = $this->htmlEl('a', $nav->name, array_merge(
            [
                'href' => $nav->getHref(),
                'title' => $nav->name
            ],
            array_merge($nav->link_attributes, $options)
        ));

        if ($nav->noindex) {
            $link = $this->htmlEl('noindex', $link, [], false);
        }

        return $link;
    }

    /**
     * @param Item|null $parentNav если NULL, то элементы из корня дерева
     * @param array $options
     * @param int $maxDepth
     * @return string
     */
    public function menu($parentNav, array $options = [], $maxDepth = 0)
    {
        if (null !== $parentNav && !($parentNav instanceof Item)) {
            $parentNav = $this
                ->itemModel
                ->whereAlias($parentNav)
                ->withDepth()
                ->firstOrFail();
        }

        $options['menu'] = array_merge(
            [
                'element' => 'ul',
                'html_options' => [],
                'check_active' => ['App\Helpers\MenuHelper', 'checkElementIsActive']
            ],
            $options['menu'] ?? []
        );

        $options['menu_item'] = array_merge(
            [
                'element' => 'li',
                'active_class' => 'active',
                'link_options' => [],
                'html_options' => []
            ],
            $options['menu_item'] ?? []
        );

        $options['child_menu'] = array_merge(
            $options['menu'],
            $options['child_menu'] ?? []
        );

        $options['child_menu_item'] = array_merge(
            $options['menu_item'],
            $options['child_menu_item'] ?? []
        );

        return $this->menuTree(
            $this->itemModel->activeChildren($parentNav, $maxDepth)->get()->toTree(),
            $options
        );
    }

    /**
     * @param Item $item
     * @return bool
     */
    public function isActive(Item $item)
    {
        $uri = Request::url();
        $href = $item->getHref();

        return strncmp($href, $uri, strlen($href)) === 0;
    }

    /**
     * @param $children
     * @param array $options
     * @param bool $root
     * @return string
     */
    private function menuTree($children, array $options, $root = true)
    {
        $menuOptions = $root ? $options['menu'] : $options['child_menu'];
        $menuItemOptions = $root ? $options['menu_item'] : $options['child_menu_item'];

        $elements = '';
        foreach ($children as $child) {
            $htmlOptions = $menuItemOptions['html_options'];
            $linkOptions = $menuItemOptions['link_options'];

            if (is_callable($menuOptions['check_active'])) {
                if (call_user_func($menuOptions['check_active'], $child)) {
                    $newClass = '';
                    if (isset($htmlOptions['class'])) {
                        $newClass = $htmlOptions['class'];
                    }
                    $htmlOptions['class'] = $newClass.' '.$menuItemOptions['active_class'];
                    if (isset($linkOptions['active_class'])){
                        $newLinkClass = '';
                        if (isset($menuItemOptions['link_options']['class'])){
                            $newLinkClass = $menuItemOptions['link_options']['class'];
                        }
                        $linkOptions['class'] = $newLinkClass . ' ' . $menuItemOptions['link_options']['active_class'];
                    }
                }
            }

            $childItemContent = $this->link($child, $linkOptions);
            if ($child->children->count()) {
                $childItemContent .= $this->menuTree($child->children, $options, false);
            }

            $elements .= $this->htmlEl(
                $menuItemOptions['element'],
                $childItemContent,
                $htmlOptions,
                false
            );
        }

        if (false === $menuOptions['element']) {
            return $elements;
        }

        return $this->htmlEl(
            $menuOptions['element'],
            $elements,
            $menuOptions['html_options'],
            false
        );
    }

    /**
     * @param array $params
     * @return string
     */
    private function htmlParams(array $params)
    {
        $pairs = [];

        foreach ($params as $key => $param) {
            $pairs[] = "$key=\"$param\"";
        }

        return implode(' ', $pairs);
    }

    /**
     * @param $name
     * @param $content
     * @param array $options
     * @param bool $escContent
     * @return string
     */
    private function htmlEl($name, $content, array $options = [], $escContent = true)
    {
        return sprintf(
            '<%s %s>%s</%s>',
            $name,
            $this->htmlParams($options),
            $escContent ? e($content) : $content,
            $name
        );
    }

}