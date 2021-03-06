<?php
namespace Enet\Ecomments\View\Comment;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Maik Hagenbruch <maik.hagenbruch@e-net.info>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * JSON view for the index action
 */
class IndexJson extends \Enet\Ecomments\View\AbstractJsonView {

	/**
	 * Get response content
	 *
	 * @return array Response content
	 */
	protected function getResponseContent() {
		$comment = $this->variables['comment'];
		$commentArray = array();
		if (!empty($comment)) {
			$commentArray = $comment->toArray();
		}
		return array(
			'errors'  => $this->getErrors(),
			'message' => $this->variables['message'],
			'status'  => $this->variables['status'],
			'comment' => $commentArray,
		);
	}

	/**
	 * Returns the validation errors
	 *
	 * @return array The errors
	 */
	protected function getErrors() {
		$errors = $this->variables['errors'];
		if (!empty($errors)) {
			foreach ($errors as $key => $error) {
				switch ($key) {
					case 'comment.name':
						$key = 'nameError';
						break;
					case 'comment.email':
						$key = 'emailError';
						break;
					case 'comment.content':
						$key = 'contentError';
						break;
				}
				$errors[$key] = array();
				foreach ($error as $singleError) {
					$errors[$key]['errorCode'] = $singleError->getCode();
					$errors[$key]['message'] = $singleError->getMessage();
				}
			}
		}
		return $errors;
	}

}
?>