<?php

class AdminController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function index() {
		return View::make('pages.admin.index');
	}

	public function getAdminAllPosts() {
		$admin_all_posts = Post::all();
		return View::make('pages.admin.admin-posts')
		->with('admin_all_posts', $admin_all_posts);
	}

	public function getAdminAllComments() {
		$admin_all_comments = Comment::all();
		return View::make('pages.admin.admin-comments')
		->with('admin_all_comments', $admin_all_comments);
	}

	public function getAdminAllMessages() {
		$admin_all_messages = Contact::all();
		return View::make('pages.admin.admin-messages')
		->with('admin_all_messages', $admin_all_messages);
	}

	public function getAdminAllOrganizations() {
		$admin_all_organizations = Organization::all();
		return View::make('pages.admin.admin-organizations')
		->with('admin_all_organizations', $admin_all_organizations);
	}

	public function getAdminAllMembers() {
		$admin_all_members = User::all();
		return View::make('pages.admin.admin-members')
		->with('admin_all_members', $admin_all_members);
	}

	public function AdminDeletePost($id) {
		$data = Post::find($id);
		$data->delete();

		return Redirect::back();
	}

	public function AdminDeleteComment($id) {
		$data = Comment::find($id);
		$data->delete();

		return Redirect::back();
	}

	public function AdminDeleteMessage($id) {
		$data = Contact::find($id);
		$data->delete();

		return Redirect::back();
	}

	public function AdminDeleteOrganization($id) {
		$data = Organization::find($id);
		$data->delete();

		return Redirect::back();
	}

	/* Member */
	public function AdminDeleteMember($id) {
		$data = User::find($id);
		$data->delete();

		return Redirect::back();
	}

	public function AdminBanMember($id) {
		$throttle = Sentry::findThrottlerByUserId(1);
		$throttle->ban();

		return Redirect::back();
	}

	public function AdminUnBanMember($id) {
		$throttle = Sentry::findThrottlerByUserId(1);
		$throttle->unBan();

		return Redirect::back();
	}
	/* Member */
}
