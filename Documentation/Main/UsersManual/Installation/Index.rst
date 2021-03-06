﻿.. include:: Images.txt

.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. ==================================================
.. DEFINE SOME TEXTROLES
.. --------------------------------------------------
.. role::   underline
.. role::   typoscript(code)
.. role::   ts(typoscript)
   :class:  typoscript
.. role::   php(code)


Installation
^^^^^^^^^^^^
You may install the extension via TER or download from https://github.com/Skyfillers/sf_simple_faq.git

The installation and initial configuration of the extension is as
following:

1. Include the static TypoScript configuration “Simple FAQ
   (sf\_simple\_faq)” in your TypoScript template

2. Create a new sysfolder in your page tree, where you create FAQs and
   categories.

3. It is necessary, thay you provide **plugin.tx_sfsimplefaq.settings.listPageUid and plugin.tx_sfsimplefaq.settings.detailPageUid**
   if you want to not show the answers in the list.

4. Include the plugin “Simple FAQ” on a page. If there is no TypoScript setting for the storagePid,
   the folder containing your FAQs needs to be set in the plugin und "Behaviour -> Record Storage Page".

   |img-res|

5. Set the necessary settings:

   1. Show show the FAQs of all categories or only the FAQs of one category.
   2. Show/Hide the category overview
   3. Enable/Disable multiple selection of category in frontend
   4. Show answers inside the list view or in a detail view.

   |img-settings|

6. You may include the little CSS file to give the layout some simple formatting:
::
  page.includeCSS {
    simple_faq = EXT:sf_simple_faq/Resources/Public/Css/simple_faq_default.css
  }