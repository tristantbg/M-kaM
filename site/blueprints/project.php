<?php if(!defined('KIRBY')) exit ?>

title: Project
files: true
pages: false
fields:
  title:
    label: Title
    type:  text
    width: 1/2
  subtitle:
    label: Subtitle
    type:  text
    width: 1/2
  date:
    label: Year
    type:  date
    format: DD/MM/YYYY
    width: 1/3
  director:
    label: Director
    type:  text
    width: 1/3
  featuredimage:
    label: Image
    type: image
    width: 1/3
  medias:
    label: Medias
    type: builder
    fieldsets:
      image:
        label: Image
        entry: >
          <img src="{{_fileUrl}}{{imagefile}}" height=120px/></br>
          <br>{{imagefile}}
        fields:
          imagefile:
            label: Image
            type: select
            mode:  single
            options: images
      video:
        entry: >
          Link : {{url}}
        label: Video
        fields:
          placeholder:
            label: Placeholder image
            type: select
            mode:  single
            options: images
          url:
            label: Link URL
            help: Youtube or Vimeo URL
            type: text