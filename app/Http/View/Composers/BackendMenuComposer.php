<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use Spatie\Menu\Html;
use Spatie\Menu\Laravel\Menu;

class BackendMenuComposer
{

    public function __construct()
    {

    }

    public function compose(View $view)
    {
        $view->with('menu', $this->menuData());
    }

    public function menuData()
    {
        $menu = Menu::new()->addItemParentClass('nav-item')->addItemClass('nav-link');
        $menu->add(Html::raw(' <li class="nav-item">
                    <a href="' . route('backend.home') . '" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            الرئيسية
                        </p>
                    </a>
                </li>'));
        if(auth()->user()->can('Create Members')) {
            $menu->add(Html::raw(' <li class="nav-item">
                <a href="' . route('backend.members.create') . '" class="nav-link">
                    <i class="nav-icon fa fa-user"></i>
                    <p>
                        إضافة لاعب
                    </p>
                </a>
            </li>'));
        }
        $menu->setAttribute('data-widget', 'treeview')
            ->setAttribute('role', 'menu')
            ->setAttribute('data-accordion', 'false');
        foreach ($this->items() as $item) {
            $func = $item['function'];
            $menu->$func(...$item['parameters']);
        }
        $menu->add(Html::raw(' <li class="nav-item">
        <a href="' . route('backend.members.getMembersReport') . '" class="nav-link">
            <i class="nav-icon fas fa-file"></i>
            <p>
                تقرير اللاعبين
            </p>
        </a>
        </li>'));

        if(auth()->user()->can('Create Admins')) {
            $menu->add(Html::raw(' <li class="nav-item">
                    <a href="' . route('backend.settings.edit') . '" class="nav-link">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            الإعدادت العامه
                        </p>
                    </a>
                </li>'));
        }
        return $menu->render();
    }

    public function items()
    {
        $list = $this->menuItemsList();
        $menuItems[] = [
            "function" => "addClass",

            "parameters" => ['nav nav-pills nav-sidebar flex-column'],
        ];
        foreach ($list as $k => $v) {
            $menuItems[] =
                [
                    "function" => "htmlIfCan",

                    "parameters" => [$v['name'],
                        view('backend.layouts._partial.menuItem', [
                            'link' => $v['link'],
                            'title' => $v['title'],
                            'iconClass' => $v['iconClass'],
                            'subMenus' => $v['subMenus'] ?? ''
                        ])
                    ]
                ];
        }
        return $menuItems;
    }

    public function menuItemsList()
    {
        return [
            'admins' => [
                'name' => 'List Admins',
                'title' => 'المستخدمين',
                'iconClass' => 'nav-icon fas fa-users',
                'link' => '#',
                'subMenus' => [
                    [
                        'link' => route('backend.admins.index'),
                        'title' => 'قائمة المستخدمين',
                        'iconClass' => 'far fa-circle nav-icon',
                    ],
                    [
                        'link' => route('backend.roles.index'),
                        'title' => 'قائمة الصلاحيات',
                        'iconClass' => 'far fa-circle nav-icon',
                    ],
                ],
            ],

            'members' => [
                'name' => 'List Members',
                'title' => 'اللاعبين',
                'iconClass' => 'nav-icon fas fa-users',
                'link' => '#',
                'subMenus' => [
                    [
                        'link' => route('backend.members.index'),
                        'title' => 'قائمة اللاعبين',
                        'iconClass' => 'far fa-circle nav-icon',
                    ],
                    [
                        'link' => route('backend.members.create'),
                        'title' => 'إضافة لاعب',
                        'iconClass' => 'far fa-circle nav-icon',
                    ],
                    [
                        'link' => route('backend.loans.index'),
                        'title' => 'قائمة الإعارات',
                        'iconClass' => 'far fa-circle nav-icon',
                    ],
                    [
                        'link' => route('backend.loans.create'),
                        'title' => 'إضافة إعارة',
                        'iconClass' => 'far fa-circle nav-icon',
                    ],
                    [
                        'link' => route('backend.escalations.index'),
                        'title' => 'التصعيد',
                        'iconClass' => 'far fa-circle nav-icon',
                    ],
                ],
            ],
            'refrees' => [
                'name' => 'List Refrees',
                'title' => 'الحكام',
                'iconClass' => 'nav-icon fas fa-users',
                'link' => '#',
                'subMenus' => [
                    [
                        'link' => route('backend.refrees.index'),
                        'title' => 'قائمة الحكام',
                        'iconClass' => 'far fa-circle nav-icon',
                    ],
                    [
                        'link' => route('backend.refrees.create'),
                        'title' => 'إضافة حكم',
                        'iconClass' => 'far fa-circle nav-icon',
                    ],
                ],
            ],
            'matches' => [
                'name' => 'List Matches',
                'title' => 'المباريات',
                'iconClass' => 'nav-icon fas fa-basketball-ball',
                'link' => '#',
                'subMenus' => [
                    [
                        'link' => route('backend.matches.index'),
                        'title' => 'قائمة المباريات',
                        'iconClass' => 'far fa-circle nav-icon',
                    ],
                    [
                        'link' => route('backend.matches.create'),
                        'title' => 'تسجيل بيانات المبارة',
                        'iconClass' => 'far fa-circle nav-icon',
                    ],
                ],
            ],

            'category' => [
                'name' => 'List Category',
                'title' => 'الإعدادت  الأساسية',
                'iconClass' => 'nav-icon fas fa-book',
                'link' => '#',
                'subMenus' => [
                    [
                        'link' => route('backend.salaries.index'),
                        'title' => 'بدلات الحكام',
                        'iconClass' => 'far fa-circle nav-icon',
                    ],
                    [
                        'link' => route('backend.sessions.index'),
                        'title' => 'قائمة المواسم',
                        'iconClass' => 'far fa-circle nav-icon',
                    ],
                    [
                        'link' => route('backend.category.index'),
                        'title' => 'قائمة الألقاب',
                        'iconClass' => 'far fa-circle nav-icon',
                    ],
                    [
                        'link' => route('backend.family.index'),
                        'title' => 'قائمة النوادى',
                        'iconClass' => 'far fa-circle nav-icon',
                    ],
                    [
                        'link' => route('backend.championships.index'),
                        'title' => 'قائمة البطولات',
                        'iconClass' => 'far fa-circle nav-icon',
                    ],

                    [
                        'link' => route('backend.status.index'),
                        'title' => 'قائمة حالة اللاعب',
                        'iconClass' => 'far fa-circle nav-icon',
                    ],
                    [
                        'link' => route('backend.groups.index'),
                        'title' => 'درجات اللاعبين',
                        'iconClass' => 'far fa-circle nav-icon',
                    ],
                    [
                        'link' => route('backend.degrees.index'),
                        'title' => 'درجات الحكام',
                        'iconClass' => 'far fa-circle nav-icon',
                    ],
                    [
                        'link' => route('backend.nationality.index'),
                        'title' => 'قائمة الجنسيات',
                        'iconClass' => 'far fa-circle nav-icon',
                    ],
                    [
                        'link' => route('backend.regions.index'),
                        'title' => 'قائمة تشكيل الفريق',
                        'iconClass' => 'far fa-circle nav-icon',
                    ],
                    [
                        'link' => route('backend.banks.index'),
                        'title' => 'البنوك',
                        'iconClass' => 'far fa-circle nav-icon',
                    ],
                    [
                        'link' => route('backend.imglookups.index'),
                        'title' => 'قاموس الصور',
                        'iconClass' => 'far fa-circle nav-icon',
                    ],
                    // [
                    //     'link' => route('backend.payments.index'),
                    //     'title' => 'قائمة طرق الدفع',
                    //     'iconClass' => 'far fa-circle nav-icon',
                    // ],
                ],
            ],
        ];
    }
}
