<?php

/**
 * * @SWG\Definition(
 * definition="shelterWith",
 * @SWG\Property(property="id", type="integer"),
 * @SWG\Property(property="user_id", type="integer"),
 * @SWG\Property(property="name", type="string"),
 * @SWG\Property(property="web_address", type="string", description = " Web address of shelter"),
 * @SWG\Property(property="address", type="string", description = "Address of shelter"),
 * @SWG\Property(property="suburb_id", type="integer"),
 * @SWG\Property(property="state_id", type="integer"),
 * @SWG\Property(property="facebook", type="string", description = " Facebook of shelter"),
 * @SWG\Property(property="twitter", type="string", description = " Twitter of shelter"),
 * @SWG\Property(property="instagram", type="string", description = "Instagram of shelter"),
 * @SWG\Property(property="about", type="string", description = "About shelter"),
 * @SWG\Property(property="avatar", type="string", description = "Avatar of shelter"),
 * @SWG\Property(property="advert_photo", type="string", description = "Add photo"),
 * @SWG\Property(property="slug", type="string", description = "Slug"),
 * @SWG\Property(property="newsletter", type="boolean", description = "Newsletter"),
 * @SWG\Property(property="terms", type="boolean", description = "Terms"),
 * @SWG\Property(property="users", type="array", items="string", description = "Users relation"),
 * @SWG\Property(property="suburb", type="array", items="string", description = "Suburb relation"),
 * @SWG\Property(property="state", type="array", items="string", description = "State relation"),
 * @SWG\Property(property="key_members", type="array", items="string", description = "Key members relation"),
 * @SWG\Property(property="shelter_enquiry", type="array", items="string", description = "Shelter enquiry relation"),
 * @SWG\Property(property="dogs", type="array", items="string", description = "Dogs relation"),
 * @SWG\Property(property="review",type="array", items="string", description = "Review relation")
 * )
 */


/**
 * * @SWG\Definition(
 * definition="shelterSlug",
 * @SWG\Property(property="id", type="integer"),
 * @SWG\Property(property="user_id", type="integer"),
 * @SWG\Property(property="name", type="string"),
 * @SWG\Property(property="web_address", type="string", description = " Web address of shelter"),
 * @SWG\Property(property="address", type="string", description = "Address of shelter"),
 * @SWG\Property(property="suburb_id", type="integer"),
 * @SWG\Property(property="state_id", type="integer"),
 * @SWG\Property(property="facebook", type="string", description = " Facebook of shelter"),
 * @SWG\Property(property="twitter", type="string", description = " Twitter of shelter"),
 * @SWG\Property(property="instagram", type="string", description = "Instagram of shelter"),
 * @SWG\Property(property="about", type="string", description = "About shelter"),
 * @SWG\Property(property="avatar", type="string", description = "Avatar of shelter"),
 * @SWG\Property(property="advert_photo", type="string", description = "Add photo"),
 * @SWG\Property(property="slug", type="string", description = "Slug"),
 * @SWG\Property(property="newsletter", type="boolean", description = "Newsletter"),
 * @SWG\Property(property="terms", type="boolean", description = "Terms"),
 * @SWG\Property(property="users", ref="#/definitions/userId", description = "User information"),
 * @SWG\Property(property="suburb", ref="#/definitions/suburb", description = "Suburb information"),
 * @SWG\Property(property="state", ref="#/definitions/state", description = "State information"),
 * @SWG\Property(property="key_members", ref="#/definitions/shelterKeyMembers", description = "Key members of shelter"),
 * @SWG\Property(property="shelter_enquiry", ref="#/definitions/shelterEnquiry", description = "Seller hobby verification information"),
 * @SWG\Property(property="dogs", ref="#/definitions/editDog", description = "Dog information"),
 * @SWG\Property(property="review", ref="#/definitions/shelterReview", description = "Review information")
 * )
 */

/**
 * * @SWG\Definition(
 * definition="shelterKeyMembers",
 * @SWG\Property(property="id", type="integer"),
 * @SWG\Property(property="shelter_id", type="string"),
 * @SWG\Property(property="type", type="string", description = " Type of key member"),
 * @SWG\Property(property="name", type="string", description = "Name of keymember"),
 * @SWG\Property(property="email", type="string", description = "Email of keymember"),
 * @SWG\Property(property="user_id", type="string", description = "Id for referencing")
 * )
 */

/**
 * * @SWG\Definition(
 * definition="shelterEnquiry",
 * @SWG\Property(property="id", type="integer"),
 * @SWG\Property(property="name", type="string", description = "Name of keymember"),
 * @SWG\Property(property="email", type="string", description = "Email of keymember"),
 * @SWG\Property(property="enquiry", type="string", description = "Shelter enquiry")
 * )
 */
