<?php

// Cleans up the database options on uninstall
delete_option( 'gr_email' );
delete_option( 'gr_orgname' );
delete_option( 'gr_orgid' );
delete_option( 'gr_amount' );