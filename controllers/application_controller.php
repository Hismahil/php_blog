<?php

abstract class ApplicationController {

	abstract protected function index();

	abstract protected function show($id);

	abstract protected function edit($id);

	abstract protected function _new();

	abstract protected function create();

	abstract protected function update($values);

	abstract protected function destroy($id);
	
}