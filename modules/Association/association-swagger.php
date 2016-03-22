<?php

/**
 * * @SWG\Definition(
 * definition="editAssociation",
 * @SWG\Property(property="id", type="integer"),
 * @SWG\Property(property="user_id", type="integer"),
 * @SWG\Property(property="name", type="string"),
 * @SWG\Property(property="suburb_id", type="integer"),
 * @SWG\Property(property="state_id", type="integer"),
 * @SWG\Property(property="avatar", type="string"),
 * @SWG\Property(property="breed", type="integer"),
 * @SWG\Property(property="about", type="string"),
 * @SWG\Property(property="banner_image", type="string"),
 * @SWG\Property(property="slug", type="string")
 * )
 */

/**
 * * @SWG\Definition(
 * definition="slugAssociation",
 * @SWG\Property(property="id", type="integer"),
 * @SWG\Property(property="user_id", type="integer"),
 * @SWG\Property(property="name", type="string"),
 * @SWG\Property(property="suburb", ref="#/definitions/suburb", description = "SuburbModel"),
 * @SWG\Property(property="state", ref="#/definitions/state", description = "StateModel"),
 * @SWG\Property(property="avatar", type="string"),
 * @SWG\Property(property="breed", ref="#/definitions/dogBreed", description = "DogBreedModel"),
 * @SWG\Property(property="about", type="string"),
 * @SWG\Property(property="banner_image", type="string"),
 * @SWG\Property(property="slug", type="string"),
 * @SWG\Property(property="members", ref="#/definitions/associationMembersSlug", description = "Association members"),
 * )
 */

/**
 * * @SWG\Definition(
 * definition="associationMembersSlug",
 * @SWG\Property(property="id", type="integer"),
 * @SWG\Property(property="seller_id", type="integer"),
 * @SWG\Property(property="association_id", type="integer"),
 * @SWG\Property(property="user", ref="#/definitions/authUserAssociation", description = "Auth user")
 * )
 */





/**
 * Class AssociationModel
 * @ORM\Entity(repositoryClass="Modules\Association\Repositories\Entities")
 * @ORM\Table(name="association_entities")
 * * @SWG\Definition(
 * definition="associationWith",
 * @SWG\Property(property="id", type="integer"),
 * @SWG\Property(property="user_id", type="integer"),
 * @SWG\Property(property="name", type="string"),
 * @SWG\Property(property="avatar", type="string", description = " Avatar"),
 * @SWG\Property(property="about", type="string", description = " General information of the association"),
 * @SWG\Property(property="banner_image", type="string", description = " Banner image"),
 * @SWG\Property(property="slug", type="string", description = "Slug"),
 * @SWG\Property(property="breed", type="array", items="string", description = "Breed relation"),
 * @SWG\Property(property="suburb", type="array", items="string", description = "Suburb relation"),
 * @SWG\Property(property="state", type="array", items="string", description = "State relation"),
 * @SWG\Property(property="members", type="array", items="string", description = "Members relation"),
 * @SWG\Property(property="key_members", type="array", items="string", description = "Key members relation"),
 * )
 */
