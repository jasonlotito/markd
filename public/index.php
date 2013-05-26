<!doctype html>
<html lang="en-US">
<head>
<meta charset="UTF-8">
<title>Markd - Easy Markdown API</title>
<link rel="stylesheet" href="/css/bootstrap.min.css"/>
</head>
<body>

<div class="container">
    <div class="row">
        <header class="span12">
            <h1>Markd - Easy Markdown API</h1>
        </header>
    </div>
    <div class="row">
        <section class="span6">
            <h2>Easy API</h2>

            <p>Markd provides an easy to use API for converting your markdown into simple HTML. We have support for
                JSON, JSONP, and raw HTML.</p>


        </section>
    </div>
    <div class="row">
        <section class="span12">
            <h3>REQUEST_METHOD: POST/GET</h3>

            End Point: <a href="http://markd.co/md">http://markd.co/md</a>

            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Key</th>
                    <th>Possible Values</th>
                    <th>Description</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Request Header: <code>Accept</code></td>
                    <td>
                        <ul>
                            <li><code>application/json</code></li>
                            <li><code>application/javascript</code></li>
                            <li><code>text/html</code></li>
                        </ul>
                    </td>
                    <td>
                        <ul>
                            <li><code>application/json</code> Returns a JSON result with the following key/value pairs
                                <dl>
                                    <dt>success</dt>
                                    <dd>boolean: (true|false)</dd>
                                    <dd>Whether or not the parse was successful</dd>
                                    <dt>output</dt>
                                    <dd>string</dd>
                                    <dd>The output of the markdown parsing</dd>
                                </dl>
                            </li>
                            <li>
                                <code>application/javascript</code> When a callback is defined, returns a JavaScript result that will call the provided callback (JSONP)
                                The callback should expect to receive the same object an application/json result would return.
                            </li>
                            <li>
                                <code>text/html</code> The markup is simply returned as the body of the document.
                            </li>
                        </ul>

                        <p class="alert alert-info">
                            <i class="icon icon-info-sign"></i>
                            Note: if more than one Accept option is provided, we use the first option found.</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        Post/Get value
                        <code>md</code>
                    </td>
                    <td>
                        markdown string
                    </td>
                    <td>
                        This is the markdown you wanted rendered into HTML.  In all cases, this is provided using the normal
                        means for the method chosen (in the URL for a GET request, or as a part of the request body for a POST request).
                    </td>
                </tr>
                </tbody>
            </table>

        </section>
    </div>
    <div class="row">
        <hr class="span12">
        <section class="editor span6">
            <h3>Editor</h3>
            <form action="/md" method="POST">
                <textarea name="md" id="markdown" style="width:460px;height:460px;box-sizing: border-box"># Markdown
## API Endpoint

You can type here, and the Markdown will be generated.

Or you can use the API.</textarea>

                <div class="form-actions">
                    <button id="generate" class="btn btn-primary">Generate HTML</button>
                    <button type="submit" class="btn">Submit Markdown</button>
                </div>
            </form>
        </section>

        <div class="span6">
            <h3>Result</h3>
            <textarea name="mdResults" id="mdResults"
                      style="height: 460px; width: 460px; box-sizing: border-box"></textarea>
        </div>
    </div>

    <hr>

</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script type="text/javascript" src="/js/bootstrap.js"></script>
<script type="text/javascript" src="/js/app.js"></script>
</body>
</html>
