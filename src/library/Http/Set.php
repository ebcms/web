<?php

declare(strict_types=1);

namespace App\Ebcms\Web\Http;

use App\Ebcms\Admin\Http\Common;
use App\Ebcms\Admin\Model\Config as ModelConfig;
use DiggPHP\Form\Builder;
use DiggPHP\Form\Component\Html;
use DiggPHP\Form\Component\SwitchItem;
use DiggPHP\Form\Component\Switchs;
use DiggPHP\Form\Component\Tab;
use DiggPHP\Form\Component\TabItem;
use DiggPHP\Form\Field\Cover;
use DiggPHP\Form\Field\Input;
use DiggPHP\Form\Field\Textarea;
use DiggPHP\Request\Request;
use DiggPHP\Router\Router;
use DiggPHP\Framework\Config;

class Set extends Common
{
    public function get(
        Router $router,
        Config $config
    ) {
        $form = new Builder('网站设置');
        $form->addItem(
            (new Tab())->addTab(
                (new TabItem('基础设置'))->addItem(
                    (new Input('网站名称', 'ebcms[web][site][name]', $config->get('site.name@ebcms.web')))->set('help', '网站标题的后缀，一般不宜过长，例如:EBCMS'),
                    (new Cover('网站标志', 'ebcms[web][site][logo]', $config->get('site.logo@ebcms.web'), $router->build('/ebcms/admin/upload')))->set('help', '最好不要上传太大的图片~'),
                    (new Switchs('是否关闭网站', 'ebcms[web][site][is_close]', $config->get('site.is_close@ebcms.web', 0)))->addSwitch(
                        (new SwitchItem('开启网站', 0))->addItem(
                            new Html('开启后前台可访问~')
                        ),
                        (new SwitchItem('关闭网站', 1))->addItem(
                            (new Input('关闭原因', 'ebcms[web][site][close_reason]', $config->get('site.close_reason@ebcms.web')))->set('help', '例如：网站维护中...')
                        )
                    ),
                    (new Input('备案号', 'ebcms[web][site][beian]', $config->get('site.beian@ebcms.web')))
                        ->set('help', '例如：京ICP备12345678-1号'),
                    (new Input('联系人电子邮箱', 'ebcms[web][site][email]', $config->get('site.email@ebcms.web')))->set('help', '例如：xxx@xxx.xxx')
                ),
                (new TabItem('META信息'))->addItem(
                    (new Input('网站标题', 'ebcms[web][site][title]', $config->get('site.title@ebcms.web')))->set('help', '首页标题，例如：好用的网站管理系统'),
                    (new Input('网站关键词', 'ebcms[web][site][keywords]', $config->get('site.keywords@ebcms.web')))->set('help', '例如：cms ebcms 内容管理系统'),
                    (new Textarea('网站简介', 'ebcms[web][site][description]', $config->get('site.description@ebcms.web')))->set('help', '例如：ebcms是好用的内容管理系统')
                )
            )
        );
        return $form;
    }

    public function post(
        Request $request,
        ModelConfig $configModel
    ) {
        $configModel->save($request->post());
        return $this->success('更新成功！');
    }
}
