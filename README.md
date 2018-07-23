# yii-components

# Install

# from Git
```bash
git clone https://github.com/studxxx/yii-components.git ./yii-components
```

# from composer
```bash
php composer.phar require studxxx/yii-components "1.*"
```

or
```bash
"studxxx/yii-components": "1.*"
```

### Documentaion

#### Get param
```php
<?php
Yii::app()->config->get('NEWS_PER_PAGE');
```

#### Add param
```php
<?php
Yii::app()->config->add([
    'param'=>'BLOG.POSTS_PER_PAGE',
    'label'=>'Записей на странице',
    'value'=>'10',
    'type'=>'string',
    'default'=>'10',
]);
```

#### Delete param
```php
<?php
Yii::app()->config->delete('BLOG.POSTS_PER_PAGE');
```
> Mass operations

#### Add params
```php
<?php
Yii::app()->config->add([
    [
        'param'=>'BLOG.POSTS_PER_PAGE',
        'label'=>'Записей на странице',
        'value'=>'10',
        'type'=>'string',
        'default'=>'10',
    ],
    [
        'param'=>'BLOG.POSTS_PER_HOME',
        'label'=>'Записей на главной странице',
        'value'=>'5',
        'type'=>'string',
        'default'=>'5',
    ],
]);

```

#### Delete params
```php
<?php
Yii::app()->config->delete([
    'BLOG.POSTS_PER_PAGE',
    'BLOG.POSTS_PER_HOME',
]);
```

#### Config module
```php
<?php

class BlogModule extends CWebModule
{
    public function init()
    {
        $this->setImport(array(
            'blog.components.*',
            'blog.models.*',
        ));
    }
 
    public function install()
    {
        Yii::app()->config->add(array(
             array(
                 'param'=>'BLOG.POSTS_PER_PAGE',
                 'label'=>'Записей на странице',
                 'value'=>'10',
                 'type'=>'string',
                 'default'=>'10',
             ),
             array(
                 'param'=>'BLOG.POSTS_PER_HOME',
                 'label'=>'Записей на главной странице',
                 'value'=>'5',
                 'type'=>'string',
                 'default'=>'5',
             ),
        ));
 
        $path = Yii::getPathOfAlias('webroot.upload.blog');
 
        if (!is_dir($path))
            @mkdir($path, 755);
    }
 
    public function uninstall()
    {
        Yii::app()->config->delete(array(
             'BLOG.POSTS_PER_PAGE',
             'BLOG.POSTS_PER_HOME',
        ));
    }
}

$module = Yii::app()->getModule($moduleName);
$module->install();


$module = Yii::app()->getModule($moduleName);
$module->uninstall();

```