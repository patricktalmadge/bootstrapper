Contributor's Guide
===================

If you're reading this you're probably interested in contributing to ``bootstrapper``.
First, I'd like to say: thankyou! Projects like this one live-and-die based on
the support they receive from others, and the fact that you're even
*considering* supporting ``bootstrapper`` is incredibly generous of you.

This document lays out guidelines and advice for contributing to ``bootstrapper``. If
you're thinking of contributing, start by reading this thoroughly and getting a
feel for how contributing to the project works. If you've still got questions
after reading this, you should go ahead and contact Patrick (on
[Twitter](http://twitter.com/DrugCrazed), or via
[email](mailto:pjr0911025+github@googlemail.com))

The guide is split into sections based on the type of contribution you're
thinking of making, with a section that covers general guidelines for all
contributors.

All Contributions
-----------------

### Be Cordial Or Be On Your Way ###

``bootstrapper`` has one very important guideline governing all forms of contribution,
including things like reporting bugs or requesting features. The guideline is
[be cordial or be on your way](http://kennethreitz.org/be-cordial-or-be-on-your-way/)
**All contributions are welcome**, but they come with an implicit social contract:
everyone must be treated with respect.

This can be a difficult area to judge, so the maintainer will enforce the
following policy. If any contributor acts rudely or aggressively towards any
other contributor, **regardless of whether they perceive themselves to be acting
in retaliation for an earlier breach of this guideline**, they will be subject
to the following steps:

1. They must apologise. This apology must be genuine in nature: "I'm sorry you
   were offended" is not sufficient. The judgement of 'genuine' is at the
   discretion of the maintainer.
2. If the apology is not offered, any outstanding and future contributions from
   the violating contributor will be rejected immediately.

Everyone involved in the ``bootstrapper`` project, the maintainer included, is bound
by this policy. Failing to abide by it leads to the offender being kicked off
the project.

#### Get Early Feedback ####

If you are contributing, do not feel the need to sit on your contribution until
it is perfectly polished and complete. It helps everyone involved for you to
seek feedback as early as you possibly can. Submitting an early, unfinished
version of your contribution for feedback in no way prejudices your chances of
getting that contribution accepted, and can save you from putting a lot of work
into a contribution that is not suitable for the project.

### Contribution Suitability ###

The project maintainer has the last word on whether or not a contribution is
suitable for ``bootstrapper``. All contributions will be considered, but from time to
time contributions will be rejected because they do not suit the project.

If your contribution is rejected, don't despair! So long as you followed these
guidelines, you'll have a much better chance of getting your next contribution
accepted.


Code Contributions
------------------

### Steps ###

When contributing code, you'll want to follow this checklist:

1. Fork the repository on GitHub and run `composer install`.
2. Run the tests to confirm they all pass on your system. If they don't, you'll
   need to investigate why they fail. If you're unable to diagnose this
   yourself, contact Patrick.
3. Write tests that demonstrate your bug or feature. Ensure that they fail.
4. Make your change.
5. Run the entire test suite again, confirming that all tests pass *including
   the ones you just added*.
6. Send a GitHub Pull Request to the main repository's ``develop`` branch.
   GitHub Pull Requests are the expected method of code collaboration on this
   project. If you object to the GitHub workflow, you may mail a patch to the
   maintainer.

The following sub-sections go into more detail on some of the points above.

### Tests & Code Coverage ###

``bootstrapper`` has a substantial suite of tests. Whenever you contribute, you
must write tests that exercise your contributed code, and you must not regress
the code coverage. We use ``phpspec`` for our tests, which is installed with
Bootstrapper.

If you've done this but want to get contributing right away, you can take
advantage of the fact that ``bootstrapper`` uses a continuous integration system.
This will automatically run the tests against any pull request raised against the
main ``bootstrapper`` repository. 

Before a contribution is merged it must have a green run through the CI system.

*Contributions that do not follow this may still be merged, but will invariably
take much longer to do so*

### Code Review ###

Contributions will not be merged until they've been code reviewed. You should
implement any code review feedback unless you strongly object to it. In the
event that you object to the code review feedback, you should make your case
clearly and calmly. If, after doing so, the feedback is judged to still apply,
you must either apply the feedback or withdraw your contribution.


Documentation Contributions
---------------------------

Documentation improvements are always welcome! The documentation files live in
the [Bootstrapper Docs repository](https://github.com/PatrickRose/bootstrapper-docs)
and are written using Laravel.

Bug Reports
-----------

Bug reports are hugely important! Before you raise one, though, please check
through the [GitHub issues](https://github.com/patricktalmadge/bootstrapper/issues),
**both open and closed**, to confirm that the bug hasn't been reported before.
Duplicate bug reports are a huge drain on the time of other contributors, and
should be avoided as much as possible.

Feature Requests
----------------

Feature requests are always welcome, but please note that all the general
guidelines for contribution apply. Also note that the importance of a feature
request *without* an associated Pull Request is always lower than the importance
of one *with* an associated Pull Request: code is more valuable than ideas.
