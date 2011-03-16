<?php

namespace Application\CommentBundle\Document;

use FOS\CommentBundle\Document\Comment as BaseComment;
use FOS\CommentBundle\Model\SignedCommentInterface;
use Application\UserBundle\Document\User;
use FOS\UserBundle\Model\UserInterface as FOSUser;

/**
 * @mongodb:Document(
 *   collection="fos_comment_comment"
 * )
 * @mongodb:HasLifecycleCallbacks
 */
class Comment extends BaseComment implements SignedCommentInterface
{
    /**
     * The author name
     *
     * @mongodb:String
     * @var string
     */
    protected $authorName = 'Anonymous';

    /**
     * The author user if any
     *
     * @mongodb:ReferenceOne(targetDocument="Application\UserBundle\Document\User")
     * @var User
     */
    protected $author;

    /**
     * @return User
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param  FOSUser
     * @return null
     */
    public function setAuthor(FOSUser $author)
    {
        $this->author = $author;
        $this->authorName = $author->getUsername();
    }

    /**
     * Convenience method for the default security blamer
     *
     * @return null
     **/
    public function setUser(User $user)
    {
        return $this->setAuthor($user);
    }

    /**
     * Get authorName
     * @return string
     */
    public function getAuthorName()
    {
        return $this->authorName;
    }

    /**
     * Set authorName
     * @return string
     */
    public function setAuthorName($authorName)
    {
        $this->authorName = $authorName;
    }
}
