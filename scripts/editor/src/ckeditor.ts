/**
 * @license Copyright (c) 2014-2024, CKSource Holding sp. z o.o. All rights reserved.
 * For licensing, see LICENSE.md or https://ckeditor.com/legal/ckeditor-oss-license
 */

import { ClassicEditor } from '@ckeditor/ckeditor5-editor-classic';

import { SimpleUploadAdapter } from '@ckeditor/ckeditor5-upload';
import { UploadAdapter } from '@ckeditor/ckeditor5-adapter-ckfinder';
import { Alignment } from '@ckeditor/ckeditor5-alignment';
import { Autoformat } from '@ckeditor/ckeditor5-autoformat';
import { Bold, Italic } from '@ckeditor/ckeditor5-basic-styles';
import { BlockQuote } from '@ckeditor/ckeditor5-block-quote';
import type { EditorConfig } from '@ckeditor/ckeditor5-core';
import { Essentials } from '@ckeditor/ckeditor5-essentials';
import { FontColor, FontFamily, FontSize } from '@ckeditor/ckeditor5-font';
import { Heading } from '@ckeditor/ckeditor5-heading';
import {
	DataFilter,
	DataSchema,
	GeneralHtmlSupport,
	HtmlComment
} from '@ckeditor/ckeditor5-html-support';
import {
	AutoImage,
	Image,
	ImageInsert,
	ImageResize,
	ImageStyle,
	ImageToolbar,
	ImageUpload
} from '@ckeditor/ckeditor5-image';
import { Indent, IndentBlock } from '@ckeditor/ckeditor5-indent';
import { AutoLink, Link } from '@ckeditor/ckeditor5-link';
import { Paragraph } from '@ckeditor/ckeditor5-paragraph';
import { SourceEditing } from '@ckeditor/ckeditor5-source-editing';
import { TextTransformation } from '@ckeditor/ckeditor5-typing';
import { Undo } from '@ckeditor/ckeditor5-undo';

// You can read more about extending the build with additional plugins in the "Installing plugins" guide.
// See https://ckeditor.com/docs/ckeditor5/latest/installation/plugins/installing-plugins.html for details.

class Editor extends ClassicEditor {
	public static override builtinPlugins = [
		SimpleUploadAdapter,
		Alignment,
		AutoImage,
		AutoLink,
		Autoformat,
		BlockQuote,
		Bold,
		DataFilter,
		DataSchema,
		Essentials,
		FontColor,
		FontFamily,
		FontSize,
		GeneralHtmlSupport,
		Heading,
		HtmlComment,
		Image,
		ImageInsert,
		ImageResize,
		ImageStyle,
		ImageToolbar,
		ImageUpload,
		Indent,
		IndentBlock,
		Italic,
		Link,
		Paragraph,
		SourceEditing,
		TextTransformation,
		Undo,
		UploadAdapter
	];

	public static override defaultConfig: EditorConfig = {
		toolbar: {
			items: [
				'heading',
				'fontColor',
				'fontFamily',
				'fontSize',
				'bold',
				'italic',
				'|',
				'alignment',
				'outdent',
				'indent',
				'|',
				'imageInsert',	
				'imageUpload',
				'link',
				'|',
				'sourceEditing'
			]
		},
		simpleUpload:{
			uploadUrl: '/ci-news/public/userfiles',

			// Enable the XMLHttpRequest.withCredentials property.
			//withCredentials: true,

			// Headers sent along with the XMLHttpRequest to the upload server.
            /* headers: {
			'X-CSRF-TOKEN': 'CSRF-Token',
			Authorization: 'Bearer <JSON Web Token>'
			} */

		},
		language: 'es',
		image: {
			toolbar: [
				'imageTextAlternative',
				'imageStyle:inline',
				'imageStyle:block',
				'imageStyle:side'
			]
		}
	};
}

export default Editor;
