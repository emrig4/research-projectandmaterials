<?php

namespace Modules\Ebook\Admin\Tabs;

use Modules\Admin\Ui\CiTab;
use Modules\Admin\Ui\CiTabs;
use Modules\Category\Entities\Category;
use Modules\User\Entities\User;
use Modules\Author\Entities\Author;
use Modules\Ebook\Entities\Currency;


class EbookTabs extends CiTabs
{
    public function make()
    {
        $this->group('ebook_information', clean(trans('ebook::ebooks.tabs.group.ebook_information')))
            ->active()
            ->add($this->information())
            ->add($this->description())
            ->add($this->bookCoveImagePdf())
            ->add($this->seo())
            ->add($this->tag());

    }

    private function information()
    {
        return tap(new CiTab('information', clean(trans('ebook::ebooks.tabs.information'))), function (CiTab $tab) {
            $tab->active();
            $tab->weight(5);
            $tab->fields(['title', 'categories','authors', 'publication_year', 'password', 'is_featured', 'is_private', 'is_active']);
            $tab->view('ebook::admin.ebooks.tabs.information', [
                'categories' => Category::treeList(),
                'currencies' => Currency::pluck('code', 'id')->prepend('Please Select', ''),
                'users' => User::list(),
                'authors' => Author::list(),
            ]);
        });
    } 
    
    private function description()
    {
        return tap(new CiTab('description', clean(trans('ebook::ebooks.tabs.description'))), function (CiTab $tab) {
            $tab->weight(10);
            $tab->fields(['description', 'short_description']);
            $tab->view('ebook::admin.ebooks.tabs.description');
        });
    }

    private function bookCoveImagePdf()
    {
        if (! auth()->user()->hasAccess('admin.files.index')) {
            return;
        }

        return tap(new CiTab('bookcoveandpdf', clean(trans('ebook::ebooks.tabs.bookcoveandpdf'))), function (CiTab $tab) {
            $tab->weight(15);
            $tab->fields(['audio_files','cover_image','ebook_file','file_type','file_url','embed_code', 'main_ebook_file','main_file_type','main_file_url']);
            $tab->view('ebook::admin.ebooks.tabs.bookcoveandpdf');
        });
    }
    
    private function seo()
    {
        return tap(new CiTab('seo', clean(trans('ebook::ebooks.tabs.seo'))), function (CiTab $tab) {
            $tab->weight(20);
            $tab->fields('slug');
            $tab->view('ebook::admin.ebooks.tabs.seo');
        });
    }

    private function tag()
    {
        return tap(new CiTab('tag', 'Tags'), function (CiTab $tab) {
            $tab->weight(20);
            $tab->fields(['title']);
            $tab->view('ebook::admin.ebooks.tabs.tag', [
                'tags' => Category::treeList(),
            ]);
        });
    }

}
