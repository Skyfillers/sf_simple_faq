

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


Reference
^^^^^^^^^

Plugin-Settings: plugin.tx\_sfsimplefaq.settings


.. ### BEGIN~OF~TABLE ###

.. container:: table-row

   Property
         listPageUid
   
   Data type
         int
   
   Description
         The page uid for the list view

.. container:: table-row

   Property
         detailPageUid
   
   Data type
         int
   
   Description
         The page uid for the detail view

.. container:: table-row

   Property
         highlightTag

   Data type
         string

   Description
         The tag which should used for highlight search terms. Use pipe (|) for content substitution.

.. container:: table-row

   Property
         trimSign

   Data type
         string

   Description
         Defines the signs which are used after text trim. Like ... or [...]. Leave empty for no signs.

.. container:: table-row

   Property
         cropChars

   Data type
         int

   Description
         Amount of chars after the text will be cropped. By default (not setting the attribute or set to 0) the text will not cropped.

.. ###### END~OF~TABLE ######

