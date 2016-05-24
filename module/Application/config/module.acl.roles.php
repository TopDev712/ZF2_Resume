<?php

$user = array(
    "/logout",
);

$jobSeeker = array(
    "/job-alert",
    "/api/job-alert",
	"/api/job-alert-delete",
	"/api/job-alert-unsubscribe",
	"/dashboard",
	"/profile",
	"/api/change-password",
	"/api/profile",
);

$guest = array(
    "/index",
    "/search",
    "/login",
    "/api/auth",
	"/register",
	"/reset-password",
	"/api/register",
	"/api/search",
	"/forgot-password",
	"/api/forgot-password",
	"/api/jobclick"
);

return array(
    'guest' => $guest,
    'jobseeker' => array_merge($guest, $user, $jobSeeker)
);
