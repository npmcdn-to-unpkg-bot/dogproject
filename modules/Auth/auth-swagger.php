<?php
/**
 * * @SWG\Definition(
 * definition="userRole",
 * @SWG\Property(property="role", type="string")
 * )
 */

/**
 * * @SWG\Definition(
 * definition="userId",
 * @SWG\Property(property="id", type="integer"),
 * @SWG\Property(property="first_name", type="string"),
 * @SWG\Property(property="last_name", type="string"),
 * @SWG\Property(property="email", type="string"),
 * @SWG\Property(property="contact_number", type="string"),
 * @SWG\Property(property="status", type="string"),
 * @SWG\Property(property="role", type="string")
 * )
 */

/**
 * * @SWG\Definition(
 * definition="token",
 * @SWG\Property(property="token", type="string")
 * )
 */

/**
 * * @SWG\Definition(
 * definition="newToken",
 * @SWG\Property(property="newToken", type="string")
 * )
 */

/**
 * * @SWG\Definition(
 * definition="authUserAssociation",
 * @SWG\Property(property="id", type="integer"),
 * @SWG\Property(property="first_name", type="string"),
 * @SWG\Property(property="last_name", type="string"),
 * @SWG\Property(property="email", type="string"),
 * @SWG\Property(property="contact_number", type="string"),
 * @SWG\Property(property="role", type="integer"),
 * @SWG\Property(property="status", type="string"),
 * @SWG\Property(property="seller", ref="#/definitions/sellerUserAssociation", description = "Seller")
 * )
 */
