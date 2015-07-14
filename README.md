# yii-components

# Install

# from Git

git clone https://github.com/studxxx/yii-components.git ./yii-components

# from composer

php composer.phar require studxxx/yii-components "1.*"

or

"studxxx/yii-components": "1.*"


```
Yii::app()->config->get('NEWS_PER_PAGE');
```


```
Yii::app()->config->add(array(
    'param'=>'BLOG.POSTS_PER_PAGE',
    'label'=>'Записей на странице',
    'value'=>'10',
    'type'=>'string',
    'default'=>'10',
));
 
Yii::app()->config->delete('BLOG.POSTS_PER_PAGE');
```


```
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
 
Yii::app()->config->delete(array(
    'BLOG.POSTS_PER_PAGE',
    'BLOG.POSTS_PER_HOME',
));
```

```
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