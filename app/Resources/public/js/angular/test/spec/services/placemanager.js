'use strict';

describe('Service: PlaceManager', function () {

  // load the service's module
  beforeEach(module('angularApp'));

  // instantiate service
  var PlaceManager;
  beforeEach(inject(function (_PlaceManager_) {
    PlaceManager = _PlaceManager_;
  }));

  it('should do something', function () {
    expect(!!PlaceManager).toBe(true);
  });

});
